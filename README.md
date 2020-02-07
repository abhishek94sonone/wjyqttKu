**Overview**

Welcome to our developer candidate technical challenge. This test covers the following areas:
 
- Understanding of github
- Understanding of Composer
- Understanding of Laravel
  - Blades
  - Routes
  - Migrations
  - Seeders
  - Models (and relationships)
  - Routes
  - Controllers
  - Validation
  - Error Handling
  - Logging
- Ability to follow standards
- Ability to explain yourself and changes made
  - Inside a PR
  - Inside your code
 
We’ve started to build a Service Center application for a local car dealership. As part of the development team, you’ve been asked to pick up where the previous developer has left off (he went in search of gold at the ends of rainbows). As with many development projects documentation is hit or miss. One thing clearly established are the coding standards (see below).

**Before you begin**

Your .env file will need these two lines:
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
After that you will need to navigate to your project database folder and use the terminal to create the sqlite db:
```
touch database.sqlite
```

**Your objective is to complete the following**
 
1. Fork this project into your own repo.
2. Get the Service Center Laravel application up and running.
3. Install Laravel Debugbar.
4. Establish an Eloquent Relationship, one-to-many between VehicleMake and VehicleModel.
5. Add a Migration to enable soft deletes on the ServiceRequest model.
6. Update the Service Request list view, allowing users to submit a new service request.
7. Build the Create Service Request form.
    1. The form should prompt the user for the following fields:
       1. Vehicle Make
       2. Vehicle Model
       3. Owner contact information (Name, Phone, Email)
       4. Service Description (plain text only)
    2. Use AJAX calls to update the vehicle model dropdown based on the selected vehicle make.
    3. Validate the user’s input using Laravel’s Validation.
8. Complete the controller to store the request.
9. Update the VehicleMakeSeeder, adding the following:
    1. Dodge
    2. Toyota
10. Update the VehicleModelsSeeder, add the following:
    1. Dodge
        1. Ram 1500
        2. Ram Rebel
    2. Toyota
        1. Tacoma
        2. Tundra
11. Update the List view, allowing users to update an existing Service Request.
12. Update the List view, allowing users to delete an existing Service Request.
13. Submit your project via PR back to our github repo.
 
**Bonus Objectives**
1. Include authentication using the built in Laravel Authentication and log the user’s activity.
2. Add the ability to conduct global search in the List view.

---

# Code Style Guide

Throughout our projects and code, we’ve needed to standardize the way we write code. We all come from different backgrounds, so our styles differ a bit. Standardization allows for readability and predictability across the board.

***

## Files

### Opening and closing tags

PHP files should always start with

`<?php`

Never use close, `?>`, tags unless the file contains mixed content.

### Naming

PHP code files should always be in UpperCamelCase, even with abbreviations.

`/app/Http/Controllers/YourPmController.php`

Not

`/app/Http/Controllers/yourPMController.php`

File names should be descriptive about the functionality they provide. Does your controller manage users' cat photos? Name it UserCatPhotosController.php.

### Location

Files should be stored in logical places. If one does not exist, create it. For example, if you write some JavaScript that extends a third party plugin, you can either put it in that third party’s folder or in the public JS folder so long as the file is aptly named.


## Code

### Variables

Avoid using overly broad variables unless they’re used for two or three consecutive lines. Variables should be descriptive, but not overly so. Try to avoid using numbers when possible in variable names unless it’s logical, like $padding15 when the padding is 15px or cm.

Variable names should be camelCased without underscores.

Good:
```
$userMessages = $this->getMessages();
$logFile = new LogFile(‘../logs/log.txt’); 
$inactiveUsers = $users->notSeen(60, ‘days’);
$chatStatus = true;
```
Bad:
```
$stuff = $this->getMessages();
$x1 = new LogFile(‘../logs/log.txt’);
$usersWhoHaventBeenSeenInALongTime = $users->notSeen(60, ‘days’);
$CHATSTATUS = true;
```

### Namespaces

Where possible, please reference class namespaces so you can avoid using absolute pathing.

Good:

```
Use \FileSystem\Objects;
….
….
$files = Files::getNewlyUploaded();
```
Bad:

`$files = \FileSystem\Objects\Files::getNewlyUploaded();`

### Creation

When creating your own class, make use of namespaces to prevent conflicting class names, regardless of how original your class name may be. You might not be the only person who thought SuperAwesomeClass2000 was a fantastic name. (It isn’t.)

### Indention

Tabs or spaces? Spaces. **2 spaces to be exact.** Addicted to tabs? Your editor can likely customize what the tab button does.

Nested or continuing statements should always be indented by 2 spaces, regardless of their length.

```
if(count($items) > 0){
  foreach($items as $item){
    echo $item.‘<br/>’;
  }
}else{
  echo ‘No items found.’;
}
```

Bad:

```
if($i == 1){
  foreach($items as $item){
  echo $item.‘<br/>’;
  }
}else{ echo ‘No items found.’; }
```

### Shorthand

We do make use of shorthand where possible. This can include the ternary operator(when simple only) and in if statements. If using the ternary operator, unless it's a simple null check or empty check, the comparison should always check to be true.

```
$messageTitle = $message != null ? $message->title : ‘New Message’;
$userStatus = $user->isAdmin() ? 'admin' : 'user';
```
In blades
```
{{ $message->title or 'No Title' }}
```

Don't use a difficult comparison
```
$access = (isAdmin($page) && $user->group == $adminGroup) || isPublic($page) ? true : false;
```

Acceptable if shorthand:
```
if(! $user->hasAccess())
  redirect('/home');

if(! $user->isAdmin())
  return '';
else
  return templatingEngine('adminInitialization');
```
### {Curly Brackets}

Opening curly brackets don’t warrant their own line. They belong immediately after their opening statement. Nor do preceeding if/elseif closures.

Good:
```
function makeBigger($size){
  $maxSize = 10;
  If($size >= $maxSize){
    return $maxSize;
  }else{
    return $size + 1;
  }
}
```
Bad:
```
function makeBigger($size)
{
  $maxSize = 10;
  If($size >= $maxSize)
  {
    return $maxSize;
  }
  else
  {
    return $size + 1;
  }
}
```
### Global Functions

If a function can be used in classes without namespacing, it should be preceeded with an underscore and should always be checked to see if the function(in its current or another form) exists. This prevents including files with overlapping function names.

```
if(! function_exists('_quickSplit')){
  function _quickSplit($separator, $string){
    ...
  }
}
```

### Alignment

Lining up multiple line items or chained methods can be tedious, but it makes the world a better place. It helps to see misconfigured items and makes them more readable overall.

Good:
```
$bannedUserIds = [
  25,
  30,
  92,
  9,
  25, // double ban
];
foreach($bannedUsers as $user){
  $user->sendMessage(
    $messageTitle,
    $messageBody,
    $sender
  );
}
$object->someReallyLongFunctionName()
  ->anotherReallyLongFunctionName()
  ->aShortFunctionName()
  ->save();
```
Bad:
```
$bannedUserIds = [ 25,
  30,
  92,
  9,
  25];

foreach($bannedUsers as $user){
  $user->sendMessage( $messageTitle, $messageBody,
    $sender
  );
}

$object->someReallyLongFunctionName()->anotherReallyLongFunctionName()->aShortFunctionName()->save();
```

### Arrays

Arrays shall be declared in short hand format only. Unless extremely compact(<5 items and short), the array items shall be unpacked into separate lines. Each item, including the last item shall include a terminating comma unless packed.

```
$items = [
  24,
  26,
  75,
  44,
  92,
  81,
  100,
];

$items = [];

$letters = [‘a’,’b’,’c’];

$data = [
  'id'             => '9',
  'title'          => 'This is a test',
  'user'           => $this->user(),
  'date'           => time(),
  'referring_user' => $referer,
];
```

### Strings

Strings are created many different ways throughout our code. Sometimes, we use single quotes and sometimes we use double quotes. `As a general rule, I propose we use double quotes only when the string contains an apostrophe(no one likes looking at ‘well, g\’day mate’) or when the string contains a variable(“well, g’day {$name}”). Always using {} to call out attention to a variable.`

Good
```
$message = ‘What is the wather like there?’;
$buttonText = “Don’t Delete!”;
$greeting = “King of the {$user->group->name}s, {$user->name}, has entered the room.’; 
```

Bad
```
$message = “What is the weather like there?”; 
$buttonText = ‘Don\’t Delete!’;
$greeting = ‘King of the ‘ . $user->group->name . ‘s,’ . $user->name . ‘, has entered the room.’; 
```

### Comments

We'd like to comment everything that isn't self explanatory. With code searching available in many editors, it's nice to have type hinting where possible by using comments.

‘one-line’ comments should be used at the end of a line of code, if applicable to only that line of code and it keeps within a reasonable length.

`$test = $this->isTest(); // Determine whether or not this is a test`

C style comments should be used for multiline comments that aren't describing functions or classes:

```
/*
  This is just a multiline comment.
  It’s describing the made up logic below.
  Pretend it has a lot of meaning.
*/
if($user->name == ‘adam’){
  return ‘Neopolitan’;
}else{
  return ‘IDK. Mango?’;
}
```

Commenting a function or class should be done above the function/class in PHPDoc format. Sublime has a snippet for it, so you can just type `doc_s` and hit Tab.

```
/**
 *
 * Get the user's favorite ice cream.
 *
 * @param    object  $user The user to test
 * @return   string  The favorite flavor of $user.
 *
 */
function favoriteIceCream($user){
  if($user->name == ‘adam’){
    return ‘Neopolitan’;
  }else{
    return ‘IDK. Mango?’;
  }
}
```

Comments in a blade file would look like the following:
```
{{--  This is a laravel comment, it does not get rendered out to HTML --}}
```

## Laravel Specifics

### Blade Naming
Blades are the dark sheep of our conventions. They’re named with camelCasing despite our file naming convention of UpperCamelCasing. Their names should be generic within their specific folder.

Good:
```
products/samples/tax.blade.php 
products/view.blade.php 
products/purchase.blade.php
products/samples/stateTax.blade.php
```

Bad:
```
productTax.php
ProductView.blade.php
purchaseProduct.blade.php
products/samples/statetax.blade.php
```

### Code

PHP Programming logic, where possible, should remain **outside** of blades. Blades are meant to keep designers eyes from being scarred by PHP. Try to avoid using `@php...@endphp` where possible.  If it's crucial to the blade, try and push the @php...@endphp to the top of the blade file.

### Laravel Routing

Laravel routes make the world easier when it comes to changing URLs. Instead of hardcoding a URL like `/app/category/item/9`, you can render it with a named route using `route(‘category.item.view’, [9])`. This way, if you ever change `/app/category/item9` to say, `/app/category/item/view/9`, you only have to update the route, and not every file its used in.

Route names should follow the convention of **objectAction** or **object.action**, not actionObject or actionObject

Route names should follow the dot notation and camelCasing also used in blades.

Good
```
->name(‘gallery.view’);
->name(‘galleryView’);
->name(‘gallery.doDelete’);
->name(‘gallery.images.doDelete’);
```
Bad
```
->name(‘galleryview’);
->name(‘deleteGallery’);
->name(‘delete_image’);
```

_I like to prepend my POST actions with “do” so that it’s obvious it’s a post route._

## Databases

Database names and columns shall only consist of lowercase letters(and numbers when necessary) and underscores.

Parent objects will always be identified by `parent_types_id`(plural):

```
modules_id
groups_id
```

The primary, auto incremented key will always be named id. ‘name’ fields should be called title. While name may be more fitting, title is used elsewhere.

```
Table: products

id
title
description
price
tax_rate
inventory_level
inventory_level_warning
categories_id
tags_id
```
```
Table: categories
id
title
description
product_count
last_purchased_product
```
```
Table: types
id
title
seo_title
```

This methodology creates a predictable schema, allowing for quicker debugging/development.

## HTML & CSS classes and IDs

Classes and IDs of elements shall never(unless external) use uppercase. Words shall be separated with a dash. They should also be descriptive and as obvious as possible.

```
<…class=”module-save”…>
<…id=”item-9”…>
```
If an element needs data tied to it, use data properties unless in a form:
```
<… class=”module-save” data-id=”9”…>
```

This allows you to reference it with jQuery easily:

```
$(‘body').on('click', '.module-save’, function(){
  alert($(this).data(‘id’));
});
```

### Qualifying classes

Elements that have different states depending on values/events shall be classed as such:

```
<…class=”module-save clicked”…> 
<…class=”btn active”…>
<…class=”save confirm-on-submit”…>
```

This will allow for reusable styling/JavaScript.

## Unique CSS/JavaScript

Each page is different. Sometimes, you need customized styling or need to override a third party plugin. If it can’t be reused, it’s fine to leave your CSS/Javascript in the relevant blade. If it’s a substantial amount of JavaScript, though, it’s better to be placed in an external .js file so that it can be cached by the user’s browser.

## Reusable CSS

If you have some CSS that needs to be bundled with the global system’s CSS, it’s best to write it as SASS, and give it to Duc or Jeremy.

## jQuery Specifics

When writing jQuery, it's important to take into consideration the scope of the elements you're trying to access. If they're outside of the original DOM scope that was loaded, most functions using $('.class') will not work due to the way we dynamically load content. You should use a more generic, scoped method like

```
$('body').on('click', '.class', function(e){
  ....
});
```

or

```
$(document).on('click', '.class', function(e){
  ...
});
```
