<?php
namespace Modules\User\Controllers;

use App\Models\ChMessage as CHMessage;
use App\Notifications\AdminChannelServices;
use Chatify\Http\Models\Message;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\FrontendController;
use Modules\Property\Models\Property;
use Modules\Review\Models\Review;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Events\UserSubscriberSubmit;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Modules\Vendor\Models\VendorRequest;
use Validator;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Illuminate\Support\Str;
use Modules\User\Models\UserPortfolio;
use Modules\Core\Models\SEO;
use Modules\Media\Models\MediaFile;
// use Modules\Chat\Models\ChMessage as CHMessage;

class PortfoiloController extends FrontendController
{
    use AuthenticatesUsers;

    protected $enquiryClass;

    public function __construct()
    {
        $this->enquiryClass = Enquiry::class;
        parent::__construct();
    }

    public function photography(){
        
        return view('User::frontend.portfolio.show');
    }
    public function detailphotography(){
        dd('sdsdas');
        return view('User::frontend.portfolio.detail');
    }
    public function showPortfolio(Request $request)
    {
        $this->checkPermission('dashboard_vendor_access');
        $user = Auth::user();
        $data = [
            'cards_report'       => Booking::getTopCardsReportForVendor($user->id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user->id),
            'page_title'         => __("Vendor Dashboard"),
            'breadcrumbs'        => [
                [
                    'name'  => __('Dashboard'),
                    'class' => 'active'
                ]
            ],
            'user'=>$user,
            'activeListingCount'=>Property::where('status','publish')->where('create_user',$user->id)->count(),
            'reviewCount'=>Review::where('status','approved')->where('vendor_id',$user->id)->count(),
            'wishListCount'=>$user->wishList()->count(),
            'messageCount'=>CHMessage::where('to_id',$user->id)->count(),
        ];
        return view('User::frontend.portfolio.index', $data);
        
    }

    public function editPortfolio(Request $request)
    {
        $this->checkPermission('dashboard_vendor_access');
        $user = Auth::user();
        
        // Get existing portfolio or create new one
        $portfolio = UserPortfolio::firstOrNew(['user_id' => $user->id]);
        
        // If new portfolio, set default packages
        if (!$portfolio->exists) {
            
            $portfolio->packages = UserPortfolio::getDefaultPackages();
            // dd($portfolio);
        }
        $data = [
            'page_title' => __("Edit Portfolio"),
            'breadcrumbs' => [
                [
                    'name' => __('Dashboard'),
                    'url' => route('vendor.dashboard')
                ],
                [
                    'name' => __('Portfolio'),
                    'url' => route('vendor.portfolio')
                ],
                [
                    'name' => __('Edit'),
                    'class' => 'active'
                ]
            ],
            'user' => $user,
            'portfolio' => $portfolio
        ];
        
        return view('User::frontend.portfolio.edit', $data);
    }
    
    public function updatePortfolio(Request $request)
    {
        $this->checkPermission('dashboard_vendor_access');
        $user = Auth::user();
        
        // Process languages
        $languages = [];
        $language_names = $request->input('language_name', []);
        $language_levels = $request->input('language_level', []);
        
        foreach ($language_names as $key => $name) {
            if (!empty($name)) {
                $languages[] = [
                    'name' => $name,
                    'level' => $language_levels[$key] ?? ''
                ];
            }
        }
        
        // Process education
        $education = [];
        // Add education processing if needed
        
        // Process packages
        $packages = [];
        $defaultPackages = UserPortfolio::getDefaultPackages();
        
        // Check which packages are enabled
        $has_basic_package = $request->has('has_basic_package');
        $has_standard_package = $request->has('has_standard_package');
        $has_premium_package = $request->has('has_premium_package');
        
        // Process Basic Package
        if ($has_basic_package) {
            $packages['basic'] = [
                'title' => $request->input('basic_package_title', $defaultPackages['basic']['title']),
                'price' => $request->input('basic_package_price', $defaultPackages['basic']['price']),
                'price_unit' => $request->input('basic_package_price_unit', $defaultPackages['basic']['price_unit']),
                'description' => $request->input('basic_package_description', $defaultPackages['basic']['description']),
                'features' => $request->input('basic_package_features', $defaultPackages['basic']['features']),
                'featured' => $request->input('basic_package_featured', 0) == 1
            ];
        }
        
        // Process Standard Package
        if ($has_standard_package) {
            $packages['standard'] = [
                'title' => $request->input('standard_package_title', $defaultPackages['standard']['title']),
                'price' => $request->input('standard_package_price', $defaultPackages['standard']['price']),
                'price_unit' => $request->input('standard_package_price_unit', $defaultPackages['standard']['price_unit']),
                'description' => $request->input('standard_package_description', $defaultPackages['standard']['description']),
                'features' => $request->input('standard_package_features', $defaultPackages['standard']['features']),
                'featured' => $request->input('standard_package_featured', 0) == 1
            ];
        }
        
        // Process Premium Package
        if ($has_premium_package) {
            $packages['premium'] = [
                'title' => $request->input('premium_package_title', $defaultPackages['premium']['title']),
                'price' => $request->input('premium_package_price', $defaultPackages['premium']['price']),
                'price_unit' => $request->input('premium_package_price_unit', $defaultPackages['premium']['price_unit']),
                'description' => $request->input('premium_package_description', $defaultPackages['premium']['description']),
                'features' => $request->input('premium_package_features', $defaultPackages['premium']['features']),
                'featured' => $request->input('premium_package_featured', 0) == 1
            ];
        }
        
        // Process gallery images
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $path = $file->store('portfolio/gallery', 'public');
                $gallery[] = [
                    'path' => $path,
                    'alt' => $request->input('gallery_alt.' . $key, '')
                ];
            }
        }
        
        // Get existing gallery images if any
        $existing_portfolio = UserPortfolio::where('user_id', $user->id)->first();
        if ($existing_portfolio && !empty($existing_portfolio->gallery)) {
            $existing_gallery = is_array($existing_portfolio->gallery) ? 
                $existing_portfolio->gallery : 
                json_decode($existing_portfolio->gallery, true);
                
            if (is_array($existing_gallery)) {
                $gallery = array_merge($existing_gallery, $gallery);
            }
        }
        
        // Create or update portfolio
        $portfolio = UserPortfolio::updateOrCreate(
            ['user_id' => $user->id],
            [
                'professional_title' => $request->input('professional_title'),
                'location' => $request->input('location'),
                'about_me' => $request->input('about_me'),
                'skills' => $request->input('skills'),
                'services' => $request->input('services'),
                'availability' => $request->input('availability'),
                'response_time' => $request->input('response_time'),
                'years_experience' => $request->input('years_experience'),
                'projects_completed' => $request->input('projects_completed'),
                'equipment' => $request->input('equipment'),
                'languages' => $languages,
                'education' => $education,
                'packages' => $packages,
                'has_basic_package' => $has_basic_package,
                'has_standard_package' => $has_standard_package,
                'has_premium_package' => $has_premium_package,
                'gallery' => $gallery
            ]
        );
        
        return redirect()->route('vendor.portfolio')->with('success', __('Portfolio updated successfully'));
    }
}
