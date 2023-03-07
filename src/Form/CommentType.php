<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $range = [];
        foreach (range(0, 5) as $key => $value) {
            $range[$value.'/5'] = $key;
        }

        $builder
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
                'choice_label' => 'title',
                'choice_value' => 'id',
                'data' => $options['movie'],
                'autocomplete' => true
            ])
            ->add('title', TextType::class)
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class)
            ->add('rating', ChoiceType::class, [
                'multiple' => false,
                'expanded' => false,
                'choices' => $range,
            ])
            ->add('terms', CheckboxType::class, [
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => Comment::class,
                'movie' => null,
            ])
            ->setAllowedTypes('movie', ['null', Movie::class])
        ;
    }
}
