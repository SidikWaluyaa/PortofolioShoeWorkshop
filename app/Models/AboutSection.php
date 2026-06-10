<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'is_active'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return 'https://lh3.googleusercontent.com/aida-public/AB6AXuDPm2DdRBKN240i8GbSy96uUxctlETJimPG2EVwCIubBELe1NsPVGlSnHMR1Frw8Ov4PQIAdF96hFSKpaVqMckIMrKLeuaG4m157XaGpwh8VsUdkMUj0aVI11OjqM2HyjjTfz-HtqLkNkLqsdfNU18dEBI7keuQ4Z9uoyNtqAH-XJoAyyPYLRRkz-TIEejDOPlmDdnK_bC3rja7UCfZJtKP0tzOFl0oXlzrubgHxpOOuHiAf-PkSk4sziyB-MC2HVEhFGU82pjlt898';
        }
        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
