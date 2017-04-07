# _SHOE STORE_

#### _Shoe Store, an app to search shoe brands and stores, 2017_

#### By _**Zach Beecher**_

## Description

_A web app to collect info on shoe brands, shoe stores, and tell users which stores carry which brands.  See the composer.json file for project dependencies._

## Setup/Installation Requirements

* _Download or clone project files_
* _Run Composer Install or Composer Update in terminal_
* _setup MAMP and go to preferences and set the document root to web folder in shoestore directory_
* https://github.com/ziggity/shoestore.git

## MySQL commands
* _These are the commands used to setup the database used in this project (type in the terminal):_
* _/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _CREATE DATABASE shoes;_
* _USE shoes;_
* _CREATE TABLE brands(name VARCHAR(255), id serial PRIMARY KEY);_
* _CREATE TABLE stores(name VARCHAR(255), id serial PRIMARY KEY);_


## Specs (include project specs below)
* _spec 1: Program lists out local shoe stores and brands of shoes they carry_
* _spec 2: User can create brands that are assigned to a store_
* _spec 3: When a user is viewing a single store, program will list out all brands that have been added so far to that store, also user can add a brand to that store, too._
* _spec 4: When a user is viewing a single brand, program will list out all stores that carry that brand and allow them to add a store to that brand._

## Known Bugs

_No known bugs,_

## Support and contact details

_If you run into any issues or have questions, ideas or concerns, please contact Zach at twitter: @zachbeecher_

## Technologies Used
* _Bootstrap 3.3.7_
* _JQuery 3.2.0_
* _Silex 1.1_
* _Twig 1.0_
* _PHPUnit 4.5.*_

### License

*This project is licensed under the MIT license*

Copyright (c) 2017 **_Zach Beecher_**
