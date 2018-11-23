<?php

namespace Brizhanev\LaravelUlogin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class LaravelUloginServiceProvider extends ServiceProvider {

  public function boot() {

    $this->setupConfig();

    $this->setupRoutes();

    $this->setupMigrations();

    $this->setupFormMacro();

  }

  private function setupConfig() {
    $this->publishes([
      __DIR__ . '/config/config.php' => config_path('laravel-ulogin.php'),
    ]); 
  }

  private function setupRoutes() {
    $this->loadRoutesFrom(__DIR__ . '/routes.php');
  }

  private function setupMigrations() {
    $this->loadMigrationsFrom(__DIR__ . '/migrations');
  }

  private function setupFormMacro() {

    app('form')->macro('uLogin', function($options = array()) {

      if (Auth::check()) {
        return view(app('config')->get('laravel-ulogin.views.logged'),  [ 'user' => Auth::user() ]);
      }
      
      if (!isset($options['mode'])) {
        $options['mode'] = app('config')->get('laravel-ulogin.mode');
      }

      $configOptions = app('config')->get('laravel-ulogin.modes', array());

      $mergedOptions = ['options' => array_merge($configOptions, $options)];

      $options = $mergedOptions['options'][$options['mode']];

      $data_ulogin = str_replace('%2C', ',', http_build_query($options, '', ';'));

      $view = app('config')->get('laravel-ulogin.views.login');

      return \View::make($view, $options, [ 'data_ulogin' => $data_ulogin ]);

    });

  }

}