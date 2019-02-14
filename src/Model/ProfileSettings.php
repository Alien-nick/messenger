<?php

declare(strict_types=1);

namespace Kerox\Messenger\Model;

use Kerox\Messenger\Helper\ValidatorTrait;
use Kerox\Messenger\Model\ProfileSettings\PaymentSettings;
use Kerox\Messenger\Model\ProfileSettings\TargetAudience;

class ProfileSettings implements \JsonSerializable
{
    use ValidatorTrait;

    /**
     * @var \Kerox\Messenger\Model\ProfileSettings\PersistentMenu[]|null
     */
    protected $persistentMenus;

    /**
     * @var array|null
     */
    protected $startButton;

    /**
     * @var \Kerox\Messenger\Model\ProfileSettings\Greeting[]|null
     */
    protected $greetings;

    /**
     * @var array|null
     */
    protected $whitelistedDomains;

    /**
     * @var string|null
     */
    protected $accountLinkingUrl;

    /**
     * @var \Kerox\Messenger\Model\ProfileSettings\PaymentSettings|null
     */
    protected $paymentSettings;

    /**
     * @var \Kerox\Messenger\Model\ProfileSettings\TargetAudience|null
     */
    protected $targetAudience;

    /**
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @param \Kerox\Messenger\Model\ProfileSettings\PersistentMenu[] $persistentMenus
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addPersistentMenus(array $persistentMenus): self
    {
        $this->persistentMenus = $persistentMenus;

        return $this;
    }

    /**
     * @param string $payload
     *
     * @throws \Exception
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addStartButton(string $payload): self
    {
        $this->isValidString($payload, 1000);

        $this->startButton = [
            'payload' => $payload,
        ];

        return $this;
    }

    /**
     * @param \Kerox\Messenger\Model\ProfileSettings\Greeting[] $greetings
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addGreetings(array $greetings): self
    {
        $this->greetings = $greetings;

        return $this;
    }

    /**
     * @param array $whitelistedDomains
     *
     * @throws \Exception
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addWhitelistedDomains(array $whitelistedDomains): self
    {
        $this->isValidDomains($whitelistedDomains);

        $this->whitelistedDomains = $whitelistedDomains;

        return $this;
    }

    /**
     * @param string $accountLinkingUrl
     *
     * @throws \Exception
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addAccountLinkingUrl(string $accountLinkingUrl): self
    {
        $this->isValidUrl($accountLinkingUrl);

        $this->accountLinkingUrl = $accountLinkingUrl;

        return $this;
    }

    /**
     * @param \Kerox\Messenger\Model\ProfileSettings\PaymentSettings $paymentSettings
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addPaymentSettings(PaymentSettings $paymentSettings): self
    {
        $this->paymentSettings = $paymentSettings;

        return $this;
    }

    /**
     * @param \Kerox\Messenger\Model\ProfileSettings\TargetAudience $targetAudience
     *
     * @return \Kerox\Messenger\Model\ProfileSettings
     */
    public function addTargetAudience(TargetAudience $targetAudience): self
    {
        $this->targetAudience = $targetAudience;

        return $this;
    }

    /**
     * @param array $domains
     *
     * @throws \Exception
     */
    private function isValidDomains(array $domains): void
    {
        $this->isValidArray($domains, 50);

        foreach ($domains as $domain) {
            $this->isValidUrl($domain);
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'persistent_menu' => $this->persistentMenus,
            'get_started' => $this->startButton,
            'greeting' => $this->greetings,
            'whitelisted_domains' => $this->whitelistedDomains,
            'account_linking_url' => $this->accountLinkingUrl,
            'payment_settings' => $this->paymentSettings,
            'target_audience' => $this->targetAudience,
        ];

        return array_filter($array);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
