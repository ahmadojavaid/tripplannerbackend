<?php

use App\Events\Admin\Blog;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/pusher/auth', function () {

  if (Auth::guard('admin')->user()) {

    $pusher = config('broadcasting.connections.pusher');
    $pusher = new Pusher($pusher['key'], $pusher['secret'], $pusher['app_id']);
    $auth = $pusher->socket_auth(request()->channel_name, request()->socket_id);

    return $auth;
  } else {
    return response()->json('', 403);
  }
});


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

  Route::name('auth.')->group(function () {
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('show.login');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('login');
    Route::get('/logout', 'Admin\Auth\LoginController@logout')->name('logout');
  });



  Route::group(['middleware' => 'auth.admin:admin'], function () {


    Route::get('/', 'Admin\Dashboard\DashboardController@index')->name('dashboard');

    //user
    Route::group([
      'prefix' => 'users',
      'as' => 'user.',
    ], function () {
      Route::get('/', 'Admin\User\UserController@index')->name('index');

      Route::get('create', 'Admin\User\UserController@create')->name('create');
      Route::post('/', 'Admin\User\UserController@store')->name('store');
      Route::group(['prefix' => '{user}'], function () {
        Route::get('edit', 'Admin\User\UserController@edit')->name('edit');
        Route::patch('/', 'Admin\User\UserController@update')->name('update');
        Route::delete('/', 'Admin\User\UserController@destroy')->name('destroy');
      });
    });


    // roles
    Route::group([
      'prefix' => 'roles',
      'as' => 'role.',
    ], function () {
      Route::get('/', 'Admin\Role\RoleController@index')->name('index');

      Route::get('create', 'Admin\Role\RoleController@create')->name('create');


      Route::post('/', 'Admin\Role\RoleController@store')->name('store');
      Route::group(['prefix' => '{role}'], function () {
        Route::get('edit', 'Admin\Role\RoleController@edit')->name('edit');
        Route::patch('/', 'Admin\Role\RoleController@update')->name('update');
        Route::delete('/', 'Admin\Role\RoleController@destroy')->name('destroy');
      });
    });

    // roles
    Route::group([
      'prefix' => 'enquires',
      'as' => 'enquire.',
    ], function () {
      Route::get('/', 'Admin\Enquire\EnquireController@index')->name('index');

      // Route::get('create', 'Admin\Role\RoleController@create')->name('create');


      // Route::post('/', 'Admin\Role\RoleController@store')->name('store');
      Route::group(['prefix' => '{enquire}'], function () {

        Route::get('/', 'Admin\Enquire\EnquireController@show')->name('show');
        //   Route::get('edit', 'Admin\Role\RoleController@edit')->name('edit');
        //   Route::patch('/', 'Admin\Role\RoleController@update')->name('update');
        //   Route::delete('/', 'Admin\Role\RoleController@destroy')->name('destroy');
      });
    });

    //article
    Route::group([
      'prefix' => 'articles',
      'as' => 'article.',
    ], function () {

      //user article
      Route::group([
        // 'prefix' => 'users',
        'as' => 'user.',
      ], function () {
        Route::get('/', 'Admin\Article\UserArticleController@index')->name('index');

        Route::get('create', 'Admin\Article\UserArticleController@create')->name('create');


        Route::post('/', 'Admin\Article\UserArticleController@store')->name('store');
        Route::delete('/delete/{article_id}', 'Admin\Article\UserArticleController@destroy')->name('destroy');
        Route::group(['prefix' => '{article}'], function () {
          Route::get('edit', 'Admin\Article\UserArticleController@edit')->name('edit');
          Route::patch('/', 'Admin\Article\UserArticleController@update')->name('update');

        });
      });
    });

    //countries
    Route::group([
      'prefix' => 'countries',
      'as' => 'country.',
    ], function () {

      Route::get('/', 'Admin\Country\CountryController@index')->name('index');
      Route::get('create', 'Admin\Country\CountryController@create')->name('create');
      Route::post('/', 'Admin\Country\CountryController@store')->name('store');
      Route::delete('delete/{country_id}','Admin\Country\CountryController@destroy')->name('delete');

      Route::group(['prefix' => '{country}'], function () {
        Route::post('/essentials', 'Admin\Country\CountryController@essentials')->name('essentials');
        Route::post('/videos', 'Admin\Country\CountryController@videos')->name('videos');
        Route::get('edit', 'Admin\Country\CountryController@edit')->name('edit');
        Route::patch('/', 'Admin\Country\CountryController@update')->name('update');
        Route::delete('/', 'Admin\Country\CountryController@destroy')->name('destroy');
      });

      Route::group([
        'prefix' => 'files',
        'as' => 'file.',
      ], function () {
        Route::post('destroy/{id}', 'Admin\Country\CountryFileController@destroy')->name('destroy');
        Route::post('upload/{id}', 'Admin\Country\CountryFileController@upload')->name('upload');
        Route::post('store/{id}', 'Admin\Country\CountryFileController@store')->name('store');
      });


      Route::group([
        'prefix' => 'places',
        'as' => 'place.',
      ], function () {

        Route::get('/', 'Admin\Place\PlaceController@index')->name('index');

        Route::get('create', 'Admin\Place\PlaceController@create')->name('create');
        Route::post('/', 'Admin\Place\PlaceController@store')->name('store');
        Route::delete('/delete/{place_id}', 'Admin\Place\PlaceController@destroy')->name('delete');
        Route::group(['prefix' => '{place}'], function () {
          Route::post('/essentials', 'Admin\Place\PlaceController@essentials')->name('essentials');
          Route::post('/videos', 'Admin\Place\PlaceController@videos')->name('videos');
          Route::get('edit', 'Admin\Place\PlaceController@edit')->name('edit');
          Route::patch('/', 'Admin\Place\PlaceController@update')->name('update');
          Route::delete('/', 'Admin\Place\PlaceController@destroy')->name('destroy');
        });


        Route::group([
          'prefix' => 'files',
          'as' => 'file.',
        ], function () {
          Route::post('destroy/{place}', 'Admin\Place\PlaceFileController@destroy')->name('destroy');
          Route::post('upload/{place}', 'Admin\Place\PlaceFileController@upload')->name('upload');
          Route::post('store/{place}', 'Admin\Place\PlaceFileController@store')->name('store');
        });
      });


      Route::group([
        'prefix' => 'itineraries',
        'as' => 'itinerary.',
      ], function () {

        Route::get('/', 'Admin\Country\CountryItineraryController@index')->name('index');

        Route::get('create', 'Admin\Country\CountryItineraryController@create')->name('create');
        Route::post('/', 'Admin\Country\CountryItineraryController@store')->name('store');
        Route::delete('/delete/{itinerary_id}', 'Admin\Country\CountryItineraryController@destroy')->name('delete');

        Route::group(['prefix' => '{itinerary}'], function () {
          Route::get('edit', 'Admin\Country\CountryItineraryController@edit')->name('edit');
          Route::patch('/', 'Admin\Country\CountryItineraryController@update')->name('update');
          Route::delete('/', 'Admin\Country\CountryItineraryController@destroy')->name('destroy');
        });
      });


      //external hotels
      //related to article editor
      Route::group([
        'prefix' => 'external-hotels',
        'as' => 'external.hotel.',
      ], function () {
        Route::post('/', 'Admin\Hotel\HotelController@storeExternalHotel')->name('store');
      });
    });


    //experiences
    Route::group([
      'prefix' => 'experiences',
      'as' => 'experience.',
    ], function () {

      Route::get('/', 'Admin\Experience\ExperienceController@index')->name('index');
      Route::get('create', 'Admin\Experience\ExperienceController@create')->name('create');
      Route::post('/', 'Admin\Experience\ExperienceController@store')->name('store');

      Route::group(['prefix' => '{experience}'], function () {
        Route::post('/essentials', 'Admin\Experience\ExperienceController@essentials')->name('essentials');
        Route::post('/videos', 'Admin\Experience\ExperienceController@videos')->name('videos');
        Route::get('edit', 'Admin\Experience\ExperienceController@edit')->name('edit');
        Route::patch('/', 'Admin\Experience\ExperienceController@update')->name('update');
        Route::delete('/delete', 'Admin\Experience\ExperienceController@destroy')->name('destroy');
      });

      //experiences files
      Route::group([
        'prefix' => 'files',
        'as' => 'file.',
      ], function () {
        Route::post('destroy/{experience}', 'Admin\Experience\ExperienceFileController@destroy')->name('destroy');
        Route::post('upload/{experience}', 'Admin\Experience\ExperienceFileController@upload')->name('upload');
        Route::post('store/{experience}', 'Admin\Experience\ExperienceFileController@store')->name('store');
      });


      //experiences categories
      Route::group([
        'prefix' => 'categories',
        'as' => 'category.',
      ], function () {

        Route::get('/', 'Admin\Experience\ExperienceCategoryController@index')->name('index');

        Route::get('create', 'Admin\Experience\ExperienceCategoryController@create')->name('create');
        Route::post('/', 'Admin\Experience\ExperienceCategoryController@store')->name('store');

        Route::group(['prefix' => '{category}'], function () {
          Route::get('edit', 'Admin\Experience\ExperienceCategoryController@edit')->name('edit');
          Route::patch('/', 'Admin\Experience\ExperienceCategoryController@update')->name('update');
          Route::delete('/', 'Admin\Experience\ExperienceCategoryController@destroy')->name('destroy');
        });
      });
    });

    //properties
    Route::group([
      'prefix' => 'properties',
      'as' => 'property.',
    ], function () {

      Route::get('/', 'Admin\Property\PropertyController@index')->name('index');
      Route::get('create', 'Admin\Property\PropertyController@create')->name('create');
      Route::post('/', 'Admin\Property\PropertyController@store')->name('store');
      Route::get('/external', 'Admin\Property\PropertyController@externalHotel')->name('external');

      Route::group(['prefix' => '{property}'], function () {
        Route::post('/essentials', 'Admin\Property\PropertyController@essentials')->name('essentials');
        Route::post('/videos', 'Admin\Property\PropertyController@videos')->name('videos');
        Route::get('edit', 'Admin\Property\PropertyController@edit')->name('edit');
        Route::patch('/', 'Admin\Property\PropertyController@update')->name('update');
        Route::delete('/', 'Admin\Property\PropertyController@destroy')->name('destroy');
      });

      //properties Files
      Route::group([
        'prefix' => 'files',
        'as' => 'file.',
      ], function () {

        Route::post('destroy/{property}', 'Admin\Property\PropertyFileController@destroy')->name('destroy');
        Route::post('upload/{property}', 'Admin\Property\PropertyFileController@upload')->name('upload');
        Route::post('store/{property}', 'Admin\Property\PropertyFileController@store')->name('store');
      });

      //property categories
      Route::group([
        'prefix' => 'categories',
        'as' => 'category.',
      ], function () {

        Route::get('/', 'Admin\Property\PropertyCategoryController@index')->name('index');

        Route::get('create', 'Admin\Property\PropertyCategoryController@create')->name('create');
        Route::post('/', 'Admin\Property\PropertyCategoryController@store')->name('store');

        Route::group(['prefix' => '{category}'], function () {
          Route::get('edit', 'Admin\Property\PropertyCategoryController@edit')->name('edit');
          Route::patch('/', 'Admin\Property\PropertyCategoryController@update')->name('update');
          Route::delete('/', 'Admin\Property\PropertyCategoryController@destroy')->name('destroy');
        });
      });

      //property types
      Route::group([
        'prefix' => 'types',
        'as' => 'type.',
      ], function () {

        Route::get('/', 'Admin\Property\PropertyTypeController@index')->name('index');

        Route::get('create', 'Admin\Property\PropertyTypeController@create')->name('create');
        Route::post('/', 'Admin\Property\PropertyTypeController@store')->name('store');

        Route::group(['prefix' => '{type}'], function () {
          Route::get('edit', 'Admin\Property\PropertyTypeController@edit')->name('edit');
          Route::patch('/', 'Admin\Property\PropertyTypeController@update')->name('update');
          Route::delete('/delete', 'Admin\Property\PropertyTypeController@destroy')->name('destroy');
        });
      });


      //external properties
      Route::group([
        'prefix' => 'externals',
        'as' => 'external.',
      ], function () {

        // Route::get('/', 'Admin\Property\ExternalPropertyController@index')->name('index');
        Route::get('create', 'Admin\Property\ExternalPropertyController@create')->name('create');
        Route::post('/', 'Admin\Property\ExternalPropertyController@store')->name('store');
        Route::post('/list', 'Admin\Property\ExternalPropertyController@list')->name('list');

        Route::group(['prefix' => '{property}'], function () {
          Route::post('/essentials', 'Admin\Property\ExternalPropertyController@essentials')->name('essentials');
          Route::post('/videos', 'Admin\Property\ExternalPropertyController@videos')->name('videos');
          Route::get('edit', 'Admin\Property\ExternalPropertyController@edit')->name('edit');
          Route::patch('/', 'Admin\Property\ExternalPropertyController@update')->name('update');
          Route::delete('/', 'Admin\Property\ExternalPropertyController@destroy')->name('destroy');
        });
      });
    });



    Route::group([
      'prefix' => 'trips',
      'as' => 'trip.',
    ], function () {

      Route::get('/', 'Admin\Trip\TripController@index')->name('index');

      Route::get('create', 'Admin\Trip\TripController@create')->name('create');
      Route::get('get-cities', 'Admin\Trip\TripController@getCities')->name('get-cities');
      Route::get('get-experiences-properties', 'Admin\Trip\TripController@getExperiencesProperties')->name('getExperiencesProperties');
      Route::post('/', 'Admin\Trip\TripController@store')->name('store');
      Route::get('/country-places', 'Admin\Trip\TripController@countryPlaces')->name('country.places');
      Route::group(['prefix' => '{trip}'], function () {
        Route::get('edit', 'Admin\Trip\TripController@edit')->name('edit');
        Route::patch('/', 'Admin\Trip\TripController@update')->name('update');
        Route::delete('/destroy', 'Admin\Trip\TripController@destroy')->name('destroy');
      });


      Route::group([
        'prefix' => 'routes',
        'as' => 'route.',
      ], function () {

        Route::get('/', 'Admin\Trip\RouteController@index')->name('index');

        Route::get('create', 'Admin\Trip\RouteController@create')->name('create');
        Route::post('/', 'Admin\Trip\RouteController@store')->name('store');


        Route::group(['prefix' => 'airports', 'as' => 'airport.'], function () {
          Route::get('create', 'Admin\Trip\AirportRouteController@create')->name('create');
          Route::post('/', 'Admin\Trip\AirportRouteController@store')->name('store');
          Route::group(['prefix' => '{route}'], function () {
            Route::get('edit', 'Admin\Trip\AirportRouteController@edit')->name('edit');
            Route::patch('/', 'Admin\Trip\AirportRouteController@update')->name('update');
          });
        });


        Route::post('/locations', 'Admin\Trip\RouteController@locations')->name('locations');
        Route::group(['prefix' => '{route}'], function () {
          Route::get('edit', 'Admin\Trip\RouteController@edit')->name('edit');
          Route::patch('/', 'Admin\Trip\RouteController@update')->name('update');
          Route::delete('/', 'Admin\Trip\RouteController@destroy')->name('destroy');
        });
      });
    });
  });



  //setting
  Route::group([
    'prefix' => 'settings',
    'as' => 'setting.',
  ], function () {
    Route::get('/', 'Admin\Setting\SettingController@index')->name('index');
    Route::get('/how-it-works-video', 'Admin\Setting\SettingController@demoVideo')->name('how-it-work-video');
    Route::post('/how-it-works-video', 'Admin\Setting\SettingController@uploadDemoVideo')->name('store.how-it-work-video');
  });
});




// ===================================================== User End ======================================================================================


Route::group(['as' => 'user.'], function () {

  Route::name('auth.')->group(function () {
    Route::post('/login', 'User\Auth\LoginController@login')->name('login');
    Route::post('/register', 'User\Auth\RegisterController@register')->name('register');
    Route::get('/password/forgot', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('show.forgot');
    Route::post('/password/forgot', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('forgot');
    Route::post('/password/reset', 'User\Auth\ResetPasswordController@reset')->name('reset');
    Route::get('/password/reset/{token}/{email}', 'User\Auth\ResetPasswordController@showResetForm')->name('show.reset');



    Route::get('email/verify/{id}/{hash}', 'User\Auth\VerificationController@verify')->name('verification.verify');

    Route::get('/logout', 'User\Auth\LoginController@logout')->name('logout');
    Route::get('/facebook-redirect', 'User\Auth\SocialLoginController@facebookRedirect')->name('facebook.redirect');
    Route::get('/facebook-callback', 'User\Auth\SocialLoginController@facebookCallback')->name('facebook.callback');
    Route::get('/google-redirect', 'User\Auth\SocialLoginController@googleRedirect')->name('google.redirect');
    Route::get('/google-callback', 'User\Auth\SocialLoginController@googleCallback')->name('google.callback');
  });


  Route::group(['middleware' => 'auth.user:web'], function () {

    Route::get('/profile', 'User\Profile\ProfileController@index')->name('profile');
    Route::patch('/profile/{user}', 'User\Profile\ProfileController@update')->name('profile.update');
    Route::get('/my-trips', 'User\Trip\UserTripsController@myTrips')->name('my-trips');
    Route::get('/trip-details/{trip_id}', 'User\Trip\UserTripsController@tripdetails')->name('my-trip-details');
    Route::get('/trip-delete/{trip_id}', 'User\Trip\UserTripsController@tripDelete')->name('my-trip-delete');
    Route::get('/trip-intro-edit/{trip_id}', 'User\Trip\UserTripsController@tripEdit')->name('my-trip-intro-edit');
    Route::get('/trip-place-edit/{trip_id}/{place_id}', 'User\Trip\UserTripsController@tripPlaceEdit')->name('my-trip-place-edit');
    Route::post('/trip-place-update','User\Trip\UserTripsController@tripPlaceUpdate')->name('my-trips-place-update');
  });

  Route::get('/', 'User\Dashboard\DashboardController@index')->name('dashboard');
  Route::get('/search', 'User\Dashboard\DashboardController@search')->name('dashboard.search');
  Route::get('/about-us', 'User\Dashboard\DashboardController@aboutUs')->name('about-us');
  Route::get('/enquire', 'User\Dashboard\DashboardController@enquire')->name('enquire');
  Route::post('/enquire', 'User\Dashboard\DashboardController@storeEnquire')->name('enquire.store');


  Route::get('/blog', 'User\Article\UserArticleController@index')->name('blog.index');
  Route::post('/country/articles', 'User\Article\UserArticleController@countryArticle')->name('country.articles');
  Route::post('/external-hotels', 'User\Article\UserArticleController@externalHotels')->name('external.hotel.list');


  Route::get('/blog/{slug}', 'User\Article\UserArticleController@article')->name('blog.article');

  Route::get('/blog/{slug}', 'User\Article\UserArticleController@article')->name('blog.article');


  Route::get('/countries/{slug}', 'User\Country\CountryController@country')->name('country.detail');
  Route::get('/places/{slug}', 'User\Country\PlaceController@place')->name('place.detail');
  Route::get('/property/{slug}', 'User\Country\PropertyController@property')->name('property.detail');
  Route::get('/experience/{slug}', 'User\Country\ExperienceController@experience')->name('experience.detail');


  //handle pin or unpin of article
  Route::post('/handle-pin', 'User\Article\PinnedArticleController@handlePin')->name('pinned.handle');

  Route::get('/experiences', 'User\Country\ExperienceController@index')->name('experience.index');


  Route::get('/trips', 'User\Trip\TripController@index')->name('trip.index');

  Route::group([
    'prefix' => 'trips',
    'as' => 'trip.',
  ], function () {
    Route::get('/', 'User\Trip\TripController@index')->name('index');
    Route::post('list', 'User\Trip\TripController@list')->name('list');
    Route::post('handle-favourite', 'User\Trip\TripController@handleFavourite')->name('favourite.handle');



    Route::group([
      'prefix' => 'places',
      'as' => 'place.',
    ], function () {
      Route::get('locations', 'User\Trip\TripPlaceController@locatons')->name('locatons');
      Route::post('locationsbyid','User\Trip\TripPlaceController@locationById')->name('placelocation');
      Route::post('locaton-popup', 'User\Trip\TripPlaceController@popup')->name('locaton.popup');
      Route::post('transport', 'User\Trip\TripPlaceController@transport')->name('locaton.transport');
    });


    Route::post('country-list', 'User\Trip\TripCreateController@countryList')->name('country.list');
    Route::post('place-list', 'User\Trip\TripCreateController@placeList')->name('place.list');
    Route::post('place', 'User\Trip\TripCreateController@place')->name('place.show');
    Route::post('add-place', 'User\Trip\TripPlaceController@add')->name('place.add');
    Route::post('experience', 'User\Trip\TripCreateController@experience')->name('experience.show');
    Route::post('add-experience', 'User\Trip\TripCreateController@addExperience')->name('place.add-experience');
    Route::post('property', 'User\Trip\TripCreateController@property')->name('property.show');
    Route::post('add-property', 'User\Trip\TripCreateController@addProperty')->name('place.add-property');
    Route::get('add-trip-into', 'User\Trip\TripCreateController@addTripIntro')->name('place.add-trip-into');
    Route::get('update-trip-into/{trip_id}', 'User\Trip\TripCreateController@updateTripIntro')->name('place.update-trip-into');
    Route::get('add-trip-transport', 'User\Trip\TripCreateController@addTripTransport')->name('place.add-trip-transport');
    Route::get('add-trip-places-nights', 'User\Trip\TripCreateController@addTripPlacesNights')->name('place.add-places-nights');


    Route::group([
      'prefix' => 'create',
      'as' => 'create.',
    ], function () {
      Route::get('/', 'User\Trip\TripCreateController@index')->name('index');
    });
    Route::get('{slug}', 'User\Trip\TripController@show')->name('show');
  });
});
