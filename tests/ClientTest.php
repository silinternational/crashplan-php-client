<?php
namespace tests;

use Crashplan\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testListUsersByEmail()
    {
        $config = include 'config-test.php';

        $client = new Client($config);

        $mockBody = Stream::factory(
            json_encode(
                [
                    "metadata" => [
                        "timestamp" => "2015-03-03T10:42:25.649-05:00",
                        "params" => [
                            "email" => "test_user@domain.org"
                        ]
                    ],
                    "data" => [
                        "totalCount" => 2,
                        "users" => [
                            [
                                "userId" => 123,
                                "userUid" => "53c47723asdf2f1f1",
                                "status" => "Active",
                                "username" => "test_user",
                                "email" => "test_user@domain.org",
                                "firstName" => "Test",
                                "lastName" => "User",
                                "quotaInBytes" => -1,
                                "orgId" => 558,
                                "orgUid" => "678045511115890321",
                                "orgName" => "Development_API",
                                "active" => true,
                                "blocked" => false,
                                "emailPromo" => true,
                                "invited" => false,
                                "orgType" => "ENTERPRISE",
                                "usernameIsAnEmail" => false,
                                "creationDate" => "2015-01-13T20:53:49.133-05:00",
                                "modificationDate" => "2015-02-25T14:59:34.216-05:00",
                                "passwordReset" => false
                            ],
                            [
                                "userId" => 456,
                                "userUid" => "c0cd9casdf643880",
                                "status" => "Active",
                                "username" => "different_user",
                                "email" => "test_user@domain.org",
                                "firstName" => "User",
                                "lastName" => "Staging",
                                "quotaInBytes" => -1,
                                "orgId" => 559,
                                "orgUid" => "678768123909624593",
                                "orgName" => "Staging",
                                "active" => true,
                                "blocked" => false,
                                "emailPromo" => true,
                                "invited" => false,
                                "orgType" => "ENTERPRISE",
                                "usernameIsAnEmail" => false,
                                "creationDate" => "2015-03-02T15:16:04.915-05:00",
                                "modificationDate" => "2015-03-02T15:16:39.689-05:00",
                                "passwordReset" => false
                            ]
                        ]
                    ]
                ]
            )
        );

        $mock = new Mock(
            [
                new Response(200, [], $mockBody),
            ]
        );

        // Add the mock subscriber to the client.
        $client->getHttpClient()->getEmitter()->attach($mock);

        // Call list users and make sure we get back the user we expect from mock
        $users = $client->listUsers(['email' => 'multiple_results@domain.org']);

        $this->assertEquals(2, $users['data']['totalCount']);

        $this->assertEquals('53c47723asdf2f1f1', $users['data']['users'][0]['userUid']);
    }

    public function testGetUser()
    {
        $config = include 'config-test.php';

        $client = new Client($config);

        $mockBody = Stream::factory(
            json_encode(
                [
                    "metadata" => [
                        "timestamp" => "2015-03-03T11:34:41.861-05:00",
                        "params" => []
                    ],
                    "data" => [
                        "userId" => 123,
                        "userUid" => "53c47asdef62f1f1",
                        "status" => "Active",
                        "username" => "test_user",
                        "email" => "test_user@domain.org",
                        "firstName" => "Test",
                        "lastName" => "User",
                        "quotaInBytes" => -1,
                        "orgId" => 558,
                        "orgUid" => "678012345665890321",
                        "orgName" => "Development_API",
                        "active" => true,
                        "blocked" => false,
                        "emailPromo" => true,
                        "invited" => false,
                        "orgType" => "ENTERPRISE",
                        "usernameIsAnEmail" => false,
                        "creationDate" => "2015-01-13T20:53:49.133-05:00",
                        "modificationDate" => "2015-02-25T14:59:34.216-05:00",
                        "passwordReset" => false
                    ]
                ]
            )
        );

        $mock = new Mock(
            [
                new Response(200, [], $mockBody),
            ]
        );

        // Add the mock subscriber to the client.
        $client->getHttpClient()->getEmitter()->attach($mock);

        // Call get user and make sure we get back the user we expect from mock
        $user = $client->getUser(['userId' => 123]);

        $this->assertEquals(123, $user['data']['userId']);
    }

    public function testAddUser()
    {
        $config = include 'config-test.php';

        $client = new Client($config);

        $mockBody = Stream::factory(
            json_encode(
                [
                    "metadata" => [
                        "timestamp" => "2015-03-03T15:25:45.630-05:00",
                        "params" => []
                    ],
                    "data" => [
                        "userId" => 123,
                        "userUid" => "e28fe5gadfw4c0e6",
                        "status" => "Active",
                        "username" => "test_user",
                        "email" => "test_user@domain.com",
                        "firstName" => "Test",
                        "lastName" => "User",
                        "quotaInBytes" => -1,
                        "orgId" => 503,
                        "orgUid" => "678914523462070292",
                        "orgName" => "Staging",
                        "active" => true,
                        "blocked" => false,
                        "emailPromo" => true,
                        "invited" => false,
                        "orgType" => "ENTERPRISE",
                        "usernameIsAnEmail" => null,
                        "creationDate" => "2015-03-03T15:25:45.523-05:00",
                        "modificationDate" => "2015-03-03T15:25:45.560-05:00",
                        "passwordReset" => false
                    ]
                ]
            )
        );

        $mock = new Mock(
            [
                new Response(200, [], $mockBody),
            ]
        );

        // Add the mock subscriber to the client.
        $client->getHttpClient()->getEmitter()->attach($mock);

        // Call get user and make sure we get back the user we expect from mock
        $user = $client->addUser(
            [
                "email" => "test_112345455433@domain.org",
                "username" => "test_user",
                "firstName" => "test",
                "lastName" => "user",
                "orgId" => 503,
                "password" => "password123",
            ]
        );

        $this->assertEquals(123, $user['data']['userId']);
    }

    public function testUpdateUser()
    {
        $config = include 'config-test.php';

        $client = new Client($config);

        $mockBody = Stream::factory(
            json_encode(
                [
                    "metadata" => [
                        "timestamp" => "2015-03-03T15:25:45.630-05:00",
                        "params" => []
                    ],
                    "data" => [
                        "userId" => 123,
                        "userUid" => "e28fe5gadfw4c0e6",
                        "status" => "Active",
                        "username" => "test_user",
                        "email" => "test_user@domain.com",
                        "firstName" => "Test",
                        "lastName" => "User",
                        "quotaInBytes" => -1,
                        "orgId" => 503,
                        "orgUid" => "678914523462070292",
                        "orgName" => "Staging",
                        "active" => true,
                        "blocked" => false,
                        "emailPromo" => true,
                        "invited" => false,
                        "orgType" => "ENTERPRISE",
                        "usernameIsAnEmail" => null,
                        "creationDate" => "2015-03-03T15:25:45.523-05:00",
                        "modificationDate" => "2015-03-03T15:25:45.560-05:00",
                        "passwordReset" => false
                    ]
                ]
            )
        );

        $mock = new Mock(
            [
                new Response(200, [], $mockBody),
            ]
        );

        // Add the mock subscriber to the client.
        $client->getHttpClient()->getEmitter()->attach($mock);

        // Call get user and make sure we get back the user we expect from mock
        $user = $client->updateUser(
            [
                "userId" => 123,
                "email" => "test_112345455433@domain.org",
                "username" => "test_user",
                "firstName" => "test",
                "lastName" => "user",
                "orgId" => 503,
                "password" => "password123",
            ]
        );

        $this->assertEquals(123, $user['data']['userId']);
    }

    public function testDeactivateUser()
    {
        $config = include 'config-test.php';

        $client = new Client($config);

        $mockBody = Stream::factory('{}');

        $mock = new Mock(
            [
                new Response(204, [], $mockBody),
            ]
        );

        // Add the mock subscriber to the client.
        $client->getHttpClient()->getEmitter()->attach($mock);

        // Call get user and make sure we get back the user we expect from mock
        $user = $client->deactivateUser(
            [
                "userId" => 7225516194326404,
                "blockUser" => false
            ]
        );

        $this->assertEquals(204, $user['statusCode']);

    }
}