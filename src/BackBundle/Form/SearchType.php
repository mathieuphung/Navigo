<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField', 'search', array(
                "required" => true,
                "attr" => array(
                    "placeholder" => "rechercher...",
                    "pattern" => "^[A-Za-z0-9_\.\:\-]{3,}$",
                    "title" => "au moins 3 caractères alphanuméric (plus '.' et '_')",
                    "class" => "form-control",
                    "id" => "top-search"
                )
            )
        );
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('csrf_protection' => false);
    }
    
    public function getName()
    {
        return 'SearchForm';
    }
}
