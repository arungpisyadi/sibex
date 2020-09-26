# SiBex

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

A more straight forward package to use SendinBlue API V3 in Laravel environment (Ex : Express Solution). The package will enable you to handle SendInBlue various functions through Laravel Facade, mostly related to building email list and managing marketing campaign.

## Requirements

* PHP 7 and later
* Laravel 5.8+

## Installation

Via Composer

``` bash
$ composer require arungpisyadi/sibex
```

## Basic Usage

    <?php
    use ArungPIsyadi\SiBex\SiBex;

    // These values is better kept save on .env file.
    $sibex = new SiBex(SIB_API_TYPE, SIB_API_KEY); // either "api-key" or "partner-key", your SendInBlue API key.

    # Account function.
    dump($account = $sibex->getAccount());
    dump('email: '.$account['email']); // there are other return parameters that you can check your self.

    # Contact function.
    // get your lists
    dump($sibex->getLists($limit, $offset));

    // create a new list.
    dump($this->sibex->createList());

    // add a new email address as out contact in SendInBlue.
    $request->email = 'test+temp01@example.com';
    dump($sibex->createContact($request->email));

    // add a contact based on email to a certain list.
    $added = $sibex->addContactToList($list_id, $emails); // $list_id must be an integer, $emails is separated by comma string.
    dump($added);
    ?>
    

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email isyadiarung@gmail.com instead of using the issue tracker.

## Credits

- [Arung Isyadi][link-author]
- [All Contributors][link-contributors]

## License

GNU. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/arungpisyadi/sibex.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/arungpisyadi/sibex.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/arungpisyadi/sibex
[link-downloads]: https://packagist.org/packages/arungpisyadi/sibex
[link-author]: https://github.com/arungpisyadi
[link-contributors]: ../../contributors
