# Laratoshl

## ATTENTION
Currently this classes are under heavy development - so I cant recommend to use them in a production environment.

## Intention
These Classes are build to give the possibility of creating own reports with the Data stored in TOSHL. Later on
I will convert this repo into a Laravel Package which you can load directly by "composer require" inside your laravel 
installation.

## Requirements
- Laravel Framework
- GuzzleHTTP > 6.0
- Nesbot\Carbon 
- TOSHL Account (Pro-Account for Stuff like Images)

## Integration

1. Register for a TOSHL Account at [TOSHL Website](https://www.toshl.com/)
2. Create a personal API Token by visiting [TOSHL Developer Page / Apps](https://developer.toshl.com/apps) while you`re logged in
3. Add the newly created token to your Laravel .env file as "TOSHL_TOKEN"
4. Create a new Folder in your rootdir called "packages" and a subsubdir "Toshl" inside the Classes Folder
5. Just put all files from this repository inside you "app" folder in a subdirectory named "Classes\Toshl"
6. Now you can import Toshl\Toshl in your controller to interact with the API (see example section). 

You can find an example Reporting Class at App\Classes\Toshl\Report\ToshlCategoryReport.

## Examples

### Get a HTML Report of all categories and its sums for current month

#### Controller 
```php
<?php

namespace App\Http\Controllers;

use Laratoshl\Report\ToshlCategoryReport;

/**
 * Class ToshlController
 * @package App\Http\Controllers
 */
class ToshlController extends Controller
{
    /**
     * Login
     * @param ToshlCategoryReport $Report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function test(ToshlCategoryReport $Report)
    {
        $data = $Report->getData();

        return view('test', compact('data'));
    }
}
```

#### View 'test'
```blade
<h1>Report - Kategorien</h1>
@foreach($data->all() as $category)
    @if($category->type != 'system')
     <h2>{{$category->name}}</h2>
        <h4>
             @if($category->type == 'income')
                {{$category->incomes->get('count')}} Buchungen |  {{$category->incomes->get('sum')}} €
             @elseif($category->type == 'expense')
                {{$category->expenses->get('count')}} Buchungen |  {{$category->expenses->get('sum')}} €
             @endif
        </h4>
     @endif
@endforeach
```
## API Functions

### getUserData  
Get the users data in a nice illuminate collection
### getAccounts  
Get a Collection of the users accounts
### getCategories 
Get a Collection of the users Categories 
### getEntriesForCurrentMonth
Get a Collection of the users entries for the current month
### getCategoriesSumsForCurrentMonth ($currency)
Get a Collection of the categories and its sums filtered by current month. Needs a currency (string)
