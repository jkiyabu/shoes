# Shoe Stores

#### March 3, 2017

#### By **Jayeson Kiyabu**

## Description
  This app will allow you to add to a list of shoe stores and the brands that they carry.

| Behavior | Input Example | Output Example |
|----------|---------------|----------------|
|user inputs a name of a new shoe brand| Nike Air Zoom | 'Nike Air Zoom'|
|user inputs a name of a new shoe store | Champs | 'Champs' |
|user selects to edit name of brand | Nike Air Zoom /  Adidas Superstar I | Adidas Superstar I |
|user selects to delete a brand | Adidas Superstar I | '' |
|user selects to edit name of shoe store | Champs /  Foot Locker | Foot Locker |
|user selects to delete shoe store | Foot Locker | '' |

## Setup/Installation Requirements

*  Clone github repository for places webpage
*  From your parent directory in terminal, run "$ composer install"
*  Run php server in terminal (from web directory) by typing "$ php -S localhost:8000"
*  in your browser type "localhost:8000"
*  Webpage will load.

##  MySQL commands:
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));
* CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));
* CREATE TABLE stores_brands (id serial PRIMARY KEY, brand_id int, store_id int);

## Known Bugs
_no known bugs._

## Technologies Used
* _HTML_
* _PHP_
* _TWIG_
* _SILEX_
* _Composer_
* _SQL_


### License
*MIT

Copyright (c) 2017 Jayeson Kiyabu All Rights Reserved.
