# Laratoshl

Currently this classes are under heavy development - so I cant recommend to use them in production environments.

## Requirements
- Laravel Framework
- GuzzleHTTP > 6.0
- Nesbot\Carbon 
- TOSHL Account (Pro-Account for Stuff like Images)

## Installation

### Prerequisites
1. Register for a TOSHL Account at [TOSHL Website](https://www.toshl.com/)
2. Create a personal API Token by visiting [TOSHL Developer Page / Apps](https://developer.toshl.com/apps) while you`re logged in
3. Add the newly created token to your Laravel .env file as "TOSHL_TOKEN"

### Add Laratoshl to your Laravel Installation

1. Take your copy of Laratoshl by
```cmd
composer require elcheffe/laratoshl
```
2. Add the ServiceProvider to you config/app.php in the 'providers' Section
```php
'providers' => [
    ...
        
    /*
     * 3rd Party Packages
     */
    Elcheffe\Laratoshl\LaratoshlServiceProvider::class
]
```

3. Publish the config file by doing:
```cmd
artisan vendor:publish --tag="laratoshl"
```

## Examples

For examples of howto use Laratoshl have a look in its "examples" folder 

```cmd
vendor/elcheffe/Laratoshl/examples
```

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
