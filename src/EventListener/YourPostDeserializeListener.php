<?php

namespace App\EventListener;

//use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\Annotation\PostDeserialize;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;

class YourPostDeserializeListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return  array(
            array(
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPostDeserialize',
                'class' => 'AppBundle\\Entity\\Movie', // if no class, subscribe to every serialization
                'format' => 'json', // optional format
                'priority' => 0, // optional priority
            ),
        );
    }

    public function onPostDeserialize(PostDeserialize $event)
    {
        dd('4');
        // Votre logique après la désérialisation
        $deserializedData = $event->getObject();
        // ...
    }
}
