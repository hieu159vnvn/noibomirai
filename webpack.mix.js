let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css');

/*
 |--------------------------------------------------------------------------
 | Admin
 |--------------------------------------------------------------------------
 |
 */
mix.js('resources/assets/js/admin/init.js', 'public/js/admin')
//user
.js('resources/assets/js/admin/user/user.js', 'public/js/admin/user')
.js('resources/assets/js/admin/user/add_user.js', 'public/js/admin/user')
.js('resources/assets/js/admin/user/edit_user.js', 'public/js/admin/user')

//menu
.js('resources/assets/js/admin/menu/menu.js', 'public/js/admin/menu')

//post
.js('resources/assets/js/admin/post/post.js', 'public/js/admin/post')
.js('resources/assets/js/admin/post/add_post.js', 'public/js/admin/post')
.js('resources/assets/js/admin/post/edit_post.js', 'public/js/admin/post')
.js('resources/assets/js/admin/post/tag/tag.js', 'public/js/admin/post/tag')
.js('resources/assets/js/admin/post/tag/edit_tag.js', 'public/js/admin/post/tag')
.js('resources/assets/js/admin/post/category/category.js', 'public/js/admin/post/category')
.js('resources/assets/js/admin/post/category/edit_category.js', 'public/js/admin/post/category')

//product
.js('resources/assets/js/admin/product/product.js', 'public/js/admin/product')
.js('resources/assets/js/admin/product/add_product.js', 'public/js/admin/product')
.js('resources/assets/js/admin/product/edit_product.js', 'public/js/admin/product')
.js('resources/assets/js/admin/product/tag/product_tag.js', 'public/js/admin/product/tag')
.js('resources/assets/js/admin/product/tag/edit_product_tag.js', 'public/js/admin/product/tag')
.js('resources/assets/js/admin/product/category/product_category.js', 'public/js/admin/product/category')
.js('resources/assets/js/admin/product/category/edit_product_category.js', 'public/js/admin/product/category')

// contact
.js('resources/assets/js/admin/contact/contact.js', 'public/js/admin/contact')
.js('resources/assets/js/admin/contact/edit_contact.js', 'public/js/admin/contact')

// config
.js('resources/assets/js/admin/config/header.js', 'public/js/admin/config')
//.js('resources/assets/js/admin/contact/edit_contact.js', 'public/js/admin/contact')

/* CSS */
.sass('resources/assets/sass/admin/style.scss', 'public/css/admin')


/*
 |--------------------------------------------------------------------------
 | Front
 |--------------------------------------------------------------------------
 |
 */
// .js('resources/assets/js/front/init.js', 'public/js/front')
// .sass('resources/assets/sass/front/style.scss', 'public/css/front')
// .sass('resources/assets/sass/front/responsive.scss', 'public/css/front');

// mix.combine([
//     'public/libraries/jquery-3.3.1.min.js',
//     'public/libraries/modernizr-custom.js',
//     'public/libraries/owlcarousel/owl.carousel.min.js',
//     'public/libraries/magiczoom/magiczoomplus.js',    
//     'public/libraries/bootstrap/js/bootstrap.min.js',
//     'public/libraries/jssor.slider-27.1.0.min.js',
// ], 'public/libraries/compined.js');

// mix.combine([
//     'public/libraries/owlcarousel/owl.carousel.min.css',
//     'public/libraries/owlcarousel/owl.theme.default.css',    
//     'public/libraries/magiczoom/magiczoom.css',
//     'public/css/front/slick.css',
//     'public/css/front/ihover.css',
//     'public/css/front/slick-theme.css',
//     'public/css/front/style.css',
//     'public/css/front/responsive.css',
// ], 'public/css/front/compined.css');