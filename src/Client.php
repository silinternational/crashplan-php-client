<?php
namespace Crashplan;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Partial Crashplan API client implemented with Guzzle.
 *
 * @method array listUsers(array $config = [])
 * @method array getUser(array $config = [])
 * @method array getCurrentUser(array $config = [])
 * @method array addUser(array $config = [])
 * @method array updateUser(array $config = [])
 * @method array deactivateUser(array $config = [])
 * @method array activateUser(array $config = [])
 */
class Client extends GuzzleClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/crashplan-api.php',
        ];

        // Ensure that the credentials are set.
        $config = $this->applyCredentials($config);

        // Create the Crashplan client.
        parent::__construct(
            $this->getHttpClientFromConfig($config),
            $this->getDescriptionFromConfig($config),
            null,
            null,
            null,
            $config
        );

        // Ensure that ApiVersion is set.
        $this->setConfig(
            'defaults',
            [
                'ApiVersion' => $this->getDescription()->getApiVersion()
            ]
        );
    }

    private function getHttpClientFromConfig(array $config)
    {
        // If a client was provided, return it.
        if (isset($config['http_client'])) {
            return $config['http_client'];
        }

        // Create a Guzzle HttpClient.
        $clientOptions = isset($config['http_client_options'])
            ? $config['http_client_options']
            : [];
        $client = new HttpClient($clientOptions);

        return $client;
    }

    private function getDescriptionFromConfig(array $config)
    {
        // If a description was provided, return it.
        if (isset($config['description'])) {
            return $config['description'];
        }

        // Load service description data.
        $data = is_readable($config['description_path'])
            ? include $config['description_path']
            : null;

        // Override description from local config if set
        if(isset($config['description_override'])){
            $data = array_merge($data, $config['description_override']);
        }

        return new Description($data);
    }

    private function applyCredentials(array $config)
    {
        // Ensure that the credentials have been provided.
        if (!isset($config['apiuser'])) {
            throw new \InvalidArgumentException(
                'You must provide an apiuser.'
            );
        }
        if (!isset($config['apipass'])) {
            throw new \InvalidArgumentException(
                'You must provide an apipass.'
            );
        }

        $authParams = ['auth' => [$config['apiuser'], $config['apipass'], 'basic']];

        $config['http_client_options'] = isset($config['http_client_options'])
            ? array_merge_recursive($config['http_client_options'], $authParams)
            : $authParams;

        // Return new config array with credentials for authentication based on Jira's requirements.
        return $config;
    }
}
