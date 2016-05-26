<?php

namespace Elcheffe\Laratoshl;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Elcheffe\Laratoshl\Entities\Account;
use Elcheffe\Laratoshl\Entities\Entry;
use Elcheffe\Laratoshl\Entities\Category;

/**
 * Class Toshl
 * Empowers you to get Data in Laravel from TOSHL API v2.
 * @link https://developer.toshl.com/docs/ | TOSHL API Documentation
 * @package Laratoshl
 * @author Daniel Schmelz
 */
class Toshl
{

    /**
     * API
     */
    public $Api = null;

    /**
     * Toshl constructor.
     */
    public function __construct()
    {
        // Get an instance of ToshlAPI
        $this->Api = app('ToshlAPI');
    }

    /**
     * Access data for the user which is linked to the token
     * @link https://developer.toshl.com/docs/me/
     * @return Collection
     */
    public function getUserData()
    {
        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('me');

        // Build a new Laravel Collection from the received user data and return it
        return $this->getUserDataCollection($responseFromAPI);
    }

    /**
     * Get the users categories
     * @link https://developer.toshl.com/docs/categories/
     * @return Collection
     */
    public function getCategories()
    {
        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('categories');

        // Build a new Laravel Collection from the received data and return it
        return $this->getCategoriesCollection($responseFromAPI);
    }

    /**
     * Get the users categories sums
     * @link https://developer.toshl.com/docs/categories/
     * @param string $currency
     * @return Collection
     * @throws \Exception
     */
    public function getCategoriesSumsForCurrentMonth($currency = 'EUR')
    {
    
        $lastDayOfMonthDate = $this->getLastDayOfMonth();

        $optionalParameters = [
            'query' => [
                'from' => date('Y-m-01'),
                'to' => $lastDayOfMonthDate->toDateString(),
                'currency' => $currency,
                'type' => 'expense',
            ]
        ];


        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('categories/sums', $optionalParameters);

        // Build a new Laravel Collection from the received data and return it
        return $this->getCategoriesSumsCollection($responseFromAPI);
    }

    /**
     * Get the users income categories sums
     * @link https://developer.toshl.com/docs/categories/
     * @param string $currency
     * @return Collection
     * @throws \Exception
     */
    public function getCategoriesIncomeSumsForCurrentMonth($currency = 'EUR')
    {

        $lastDayOfMonthDate = $this->getLastDayOfMonth();

        $optionalParameters = [
            'query' => [
                'from' => date('Y-m-01'),
                'to' => $lastDayOfMonthDate->toDateString(),
                'currency' => $currency,
                'type' => 'income',
            ]
        ];


        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('categories/sums', $optionalParameters);

        // Build a new Laravel Collection from the received data and return it
        return $this->getCategoriesSumsCollection($responseFromAPI);
    }

    /**
     * Get the users  categories expenses
     * @link https://developer.toshl.com/docs/categories/
     * @param string $currency
     * @return Collection
     * @throws \Exception
     */
    public function getCategoriesExpenseSumsForCurrentMonth($currency = 'EUR')
    {

        $lastDayOfMonthDate = $this->getLastDayOfMonth();

        $optionalParameters = [
            'query' => [
                'from' => date('Y-m-01'),
                'to' => $lastDayOfMonthDate->toDateString(),
                'currency' => $currency,
                'type' => 'expense',
            ]
        ];


        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('categories/sums', $optionalParameters);

        // Build a new Laravel Collection from the received data and return it
        return $this->getCategoriesSumsCollection($responseFromAPI);
    }
    
    /**
     * Get the users Accounts
     * @link https://developer.toshl.com/docs/categories/
     * @return Collection
     */
    public function getAccounts()
    {
        // Send the request to the API
        $responseFromAPI = $this->Api->sendGetRequestToAPI('accounts');

        // Build a new Laravel Collection from the received data and return it
        return $this->getAccountsCollection($responseFromAPI);
    }

    /**
     * Get the users Entries for the current month
     * @link https://developer.toshl.com/docs/entries/
     * @return Collection
     */
    public function getEntriesForCurrentMonth()
    {
        $lastDayOfMonthDate = $this->getLastDayOfMonth();

        // Send the request to the API

        $optionalParameters = [
            'query' => [
                'from' => date('Y-m-01'),
                'to' => $lastDayOfMonthDate->toDateString()
            ]
        ];

        $responseFromAPI = $this->Api->sendGetRequestToAPI('entries', $optionalParameters);

        // Build a new Laravel Collection from the received data and return it
        return $this->getEntriesCollection($responseFromAPI);
    }
    
    /**
     * Build a new Laravel Collection from the Raw API response
     * @param $responseFromAPI
     * @return Collection
     */
    private function getUserDataCollection($responseFromAPI)
    {
        $userData = new Collection();

        $explodedJoined = explode('T',$responseFromAPI->joined);

        $userData->put('user_id', $responseFromAPI->id);
        $userData->put('user_email', $responseFromAPI->email);
        $userData->put('user_first_name', $responseFromAPI->first_name);
        $userData->put('user_last_name', $responseFromAPI->last_name);
        $userData->put('user_joined', Carbon::createFromFormat('Y-m-d H:i:sZ', $explodedJoined[0].' '.$explodedJoined[1], $responseFromAPI->timezone ));
        $userData->put('user_modified', Carbon::createFromFormat('Y-m-d H:i:s.u', $responseFromAPI->modified, $responseFromAPI->timezone ));
        $userData->put('user_currency', $responseFromAPI->currency->main);
        $userData->put('user_start_day', $responseFromAPI->start_day);
        $userData->put('month_from', $responseFromAPI->month->from);
        $userData->put('month_to', $responseFromAPI->month->to);
        $userData->put('user_locale', $responseFromAPI->locale);
        $userData->put('user_timezone', $responseFromAPI->timezone);
        $userData->put('user_country', $responseFromAPI->country);

        return $userData;
    }

    /**
     * Build a new Laravel Collection from the Raw API response
     * @param $responseFromAPI
     * @return Collection
     */
    private function getCategoriesCollection($responseFromAPI)
    {
        $categories = new Collection();

        foreach ($responseFromAPI as $item) {
            $Category = new Category;
            $Category->id = $item->id;
            $Category->name = $item->name;
            $Category->modified = Carbon::createFromFormat('Y-m-d H:i:s.u', $item->modified);
            $Category->type = $item->type;
            $Category->deleted = $item->deleted;
            $Category->transient_created =Carbon::createFromFormat('Y-m-d H:i:s.u', $item->transient_created);
            $Category->counts = new Collection([
              'entries' =>   $item->counts->entries,
              'tags_used_with_category' =>   $item->counts->tags_used_with_category,
              'tags' =>   $item->counts->tags,
              'budgets' =>   $item->counts->budgets,
            ]);
            $categories->push($Category);
        }
        
        return $categories;
    }

    /**
     * Build a new Laravel Collection from the Raw API response
     * @param $responseFromAPI
     * @return Collection
     */
    private function getCategoriesSumsCollection($responseFromAPI)
    {
        $categories = new Collection();

        foreach ($responseFromAPI as $item) {
            $Category = new Category;
            $Category->id = $item->category;
            $Category->name = $item->category_name;
            $Category->modified = Carbon::createFromFormat('Y-m-d H:i:s.u', $item->modified);
            $Category->type = $item->category_type;
            if(isset($item->expenses) && isset($item->incomes)) {

                $Category->incomes = new Collection([
                    'count' =>   $item->incomes->count,
                    'sum' =>   $item->incomes->sum,
                ]);

                $Category->expenses = new Collection([
                    'count' =>   $item->expenses->count,
                    'sum' =>   $item->expenses->sum,
                ]);
            }
            elseif(isset($item->incomes)) {
                $Category->incomes = new Collection([
                    'count' =>   $item->incomes->count,
                    'sum' =>   $item->incomes->sum,
                ]);
            } else  {
                $Category->expenses = new Collection([
                    'count' =>   $item->expenses->count,
                    'sum' =>   $item->expenses->sum,
                ]);
            }

            $categories->push($Category);
        }

        return $categories;
    }

    /**
     * Build a new Laravel Collection from the Raw API response
     * @param $responseFromAPI
     * @return Collection
     */
    private function getAccountsCollection($responseFromAPI)
    {
        $accounts = new Collection();

        foreach ($responseFromAPI as $item) {
            $Account = new Account();
            $Account->id = $item->id;
            $Account->name = $item->name;
            $Account->modified = Carbon::createFromFormat('Y-m-d H:i:s.u', $item->modified);
            $Account->balance = $item->balance;
            $Account->currency = new Collection([
                'code' =>   $item->currency->code,
                'rate' =>   $item->currency->rate,
                'fixed' =>   $item->currency->fixed
            ]);
            $Account->median = new Collection([
                'expenses' =>   $item->daily_sum_median->expenses,
                'incomes' =>   $item->daily_sum_median->incomes,
            ]);
            $Account->status = $item->status;
            $Account->order = $item->order;
            $accounts->push($Account);
        }

        return $accounts;
    }

    /**
     * Build a new Laravel Collection from the Raw API response
     * @param $responseFromAPI
     * @return Collection
     */
    private function getEntriesCollection($responseFromAPI)
    {

        $entries = new Collection();

        foreach ($responseFromAPI as $item) {
            $Entry = new Entry();
            $Entry->id = $item->id;
            $Entry->amount = $item->amount;
            $Entry->currency = new Collection([
                'code' =>   $item->currency->code,
                'rate' =>   $item->currency->rate,
                'fixed' =>   $item->currency->fixed
            ]);
            $Entry->date = Carbon::createFromFormat('Y-m-d', $item->date);
            $Entry->desc = $item->desc;
            $Entry->account =  $item->account;

            if(isset($item->category)) {
                $Entry->category = $item->category;
            }

            if(isset($item->tags)) {
                $Entry->tags = new Collection();
                foreach ($item->tags as $tag) {
                    $Entry->tags->push($tag);
                }
            }

            if(isset($item->location)) {
                $Entry->location = new Collection([
                    'id' => $item->location->id,
                    'latitude' => $item->location->latitude,
                    'longitude' => $item->location->longitude
                ]);
            }

            if(isset($item->images)) {
                $Entry->images = new Collection();
                foreach ($item->images as $image) {
                    $Entry->images->push($image);
                }
            }
            $Entry->modified = Carbon::createFromFormat('Y-m-d H:i:s.u', $item->modified);
            $Entry->completed =  $item->completed;

            $entries->push($Entry);
        }

        return $entries;
    }

    /**
     * Get the last day of the month as Carbon Object
     * @return Carbon
     */
    private function getLastDayOfMonth()
    {
        // Get the last day of the month
        $date = Carbon::now();
        $date->addMonth();
        $date->day = 0;
        return $date;
    }
}

