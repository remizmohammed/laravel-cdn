<?php

namespace BreachAware\LaravelCdn\Validators;

use BreachAware\LaravelCdn\Exceptions\MissingConfigurationException;
use BreachAware\LaravelCdn\Validators\Contracts\ProviderValidatorInterface;

/**
 * Class ProviderValidator.
 *
 * @category
 *
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class ProviderValidator extends Validator implements ProviderValidatorInterface
{
    /**
     * Checks for any required configuration is missed.
     *
     * @param $configuration
     * @param $required
     *
     * @throws \BreachAware\LaravelCdn\Exceptions\MissingConfigurationException
     */
    public function validate($configuration, $required)
    {
        // search for any null or empty field to throw an exception
        $missing = '';
        foreach ($configuration as $key => $value) {
            if (in_array($key, $required) &&
                (empty($value) || $value == null || $value == '')
            ) {
                $missing .= ' '.$key;
            }
        }

        if ($missing) {
            throw new MissingConfigurationException('Missed Configuration:'.$missing);
        }
    }
}
