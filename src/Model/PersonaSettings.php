<?php

declare(strict_types=1);

namespace Kerox\Messenger\Model;

use Kerox\Messenger\Helper\ValidatorTrait;

class PersonaSettings implements \JsonSerializable
{
    use ValidatorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $profilePictureUrl;

    /**
     * Persona constructor.
     */
    public function __construct(string $name, string $profilePictureUrl)
    {
        $this->isValidUrl($profilePictureUrl);

        $this->name = $name;
        $this->profilePictureUrl = $profilePictureUrl;
    }

    /**
     * @return \Kerox\Messenger\Model\PersonaSettings
     */
    public static function create(string $name, string $profilePictureUrl): self
    {
        return new self($name, $profilePictureUrl);
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'profile_picture_url' => $this->profilePictureUrl,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
