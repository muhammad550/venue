<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserPortfolio extends Model
{
    protected $table = 'bc_user_portfolios';

    protected $fillable = [
        'user_id',
        'professional_title',
        'location',
        'about_me',
        'skills',
        'services',
        'availability',
        'response_time',
        'years_experience',
        'projects_completed',
        'equipment',
        'languages',
        'packages',
        'has_basic_package',
        'has_standard_package',
        'has_premium_package',
        'gallery'
    ];

    protected $casts = [
        'packages' => 'array',
        'gallery' => 'array',
        'has_basic_package' => 'boolean',
        'has_standard_package' => 'boolean',
        'has_premium_package' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get default packages structure
     */
    public static function getDefaultPackages()
    {
        return [
            'basic' => [
                'title' => 'Basic',
                'price' => 499,
                'price_unit' => 'event',
                'description' => 'Perfect for small events and portrait sessions. Get high-quality photos with essential editing.',
                'features' => "4 hours of photography coverage\n100+ professionally edited photos\nOnline gallery with digital downloads\nPrint release included\nOne outfit/location",
                'featured' => false
            ],
            'standard' => [
                'title' => 'Standard',
                'price' => 999,
                'price_unit' => 'event',
                'description' => 'Ideal for weddings and medium-sized events. Comprehensive coverage with premium editing.',
                'features' => "8 hours of photography coverage\n300+ professionally edited photos\nOnline gallery with digital downloads\nPrint release included\nTwo outfits/locations\nEngagement session included\nSecond photographer",
                'featured' => true
            ],
            'premium' => [
                'title' => 'Premium',
                'price' => 1499,
                'price_unit' => 'event',
                'description' => 'The ultimate package for large events and luxury weddings. Premium coverage with exceptional service.',
                'features' => "12 hours of photography coverage\n500+ professionally edited photos\nOnline gallery with digital downloads\nPrint release included\nUnlimited outfits/locations\nEngagement session included\nSecond photographer\nWedding album (10x10, 20 pages)\nSame-day slideshow",
                'featured' => false
            ]
        ];
    }
}
