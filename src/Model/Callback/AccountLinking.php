<?php

declare(strict_types=1);

namespace Kerox\Messenger\Model\Callback;

class AccountLinking
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $authorizationCode;

    /**
     * AccountLinking constructor.
     *
     * @param string      $status
     * @param string|null $authorizationCode
     */
    public function __construct(string $status, ?string $authorizationCode = null)
    {
        $this->status = $status;
        $this->authorizationCode = $authorizationCode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function hasAuthorizationCode(): bool
    {
        return $this->authorizationCode !== null;
    }

    /**
     * @return string|null
     */
    public function getAuthorizationCode(): ?string
    {
        return $this->authorizationCode;
    }

    /**
     * @param array $callbackData
     *
     * @return \Kerox\Messenger\Model\Callback\AccountLinking
     */
    public static function create(array $callbackData): self
    {
        $authorizationCode = $callbackData['authorization_code'] ?? null;

        return new self($callbackData['status'], $authorizationCode);
    }
}
