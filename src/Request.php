<?php

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\LinksCollection;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use League\OAuth2\Client\Token\AccessToken;

class Request
{
    private ContactModel $contact;
    private LeadModel $lead;
    private $email, $price, $phone, $name;
    private AmoCRMApiClient $apiClient;
    private CustomFieldsValuesCollection $customFieldsValuesCollection;

    public function __construct($email, $price, $phone, $name)
    {
        $this->email = $email;
        $this->price = $price;
        $this->phone = $phone;
        $this->name = $name;
        $this->customFieldsValuesCollection = new CustomFieldsValuesCollection();

        $config = include_once '../config/amocrmConfig.php';
        $this->apiClient = new AmoCRMApiClient(
            $config['CLIENT_ID'],
            $config['CLIENT_SECRET'],
            $config['CLIENT_REDIRECT_URL']
        );
        $this->apiClient->setAccountBaseDomain($config['ACCOUNT_DOMAIN']);

        $rawToken = json_decode(file_get_contents('../token.json'), 1);
        $token = new AccessToken($rawToken);
        $this->apiClient->setAccessToken($token);
    }

    //создает сделку
    public function createLead()
    {
        $this->lead = new LeadModel();
        $this->lead->setName('')
            ->setPrice($this->price);
        $this->apiClient->leads()->addOne($this->lead);
    }

    //прикрепляет контакт к сделке
    public function connectContactToLead()
    {
        $links = new LinksCollection();
        $links->add($this->lead);
        $this->apiClient->contacts()->link($this->contact, $links);
    }

    //создает контакт
    public function createContact()
    {
        $this->contact = new ContactModel();
        $this->contact->setName($this->name);
        $this->addCustomField('EMAIL', $this->email);
        $this->addCustomField('PHONE', $this->phone);
        $this->contact->setCustomFieldsValues($this->customFieldsValuesCollection);
        $this->apiClient->contacts()->addOne($this->contact);
    }

    //добавляет кастомное поле к контакту
    private function addCustomField($key, $value)
    {
        $customField = (new MultitextCustomFieldValuesModel())->setFieldCode($key);
        $multitextCustomFieldValueCollection = new MultitextCustomFieldValueCollection();
        $multitextCustomFieldModel = new MultitextCustomFieldValueModel();

        $multitextCustomFieldModel->setValue($value)
            ->setEnum('WORK');
        $multitextCustomFieldValueCollection->add($multitextCustomFieldModel);
        $customField->setValues($multitextCustomFieldValueCollection);
        $this->customFieldsValuesCollection->add($customField);
    }

    //для демонстрации изменений
    public function showAllLeads()
    {
        echo '<pre>';
        print_r($this->apiClient->leads()->get()->toArray());
        echo '</pre>';
    }

    //для демонстрации изменений
    public function showAllContacts()
    {
        echo '<pre>';
        print_r($this->apiClient->contacts()->get()->toArray());
        echo '</pre>';
    }

}