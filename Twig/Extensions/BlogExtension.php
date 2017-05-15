<?php
// src/BlogBundle/Twig/Extensions/BlogExtension.php

namespace BlogBundle\Twig\Extensions;

class BlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('created_ago', array($this, 'createdAgo')),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \InvalidArgumentException("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = $time . " second" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta <= 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta <= 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "") . " ago";
        }
        else if($delta <= 604800)
        {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta <= 18144000)
        {
            // Weeks
            $time = floor($delta / 604800);
            $duration = $time . " week" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta <= 2419200)
        {
            // Weeks
            $time = floor($delta / 604800);
            $duration = $time . " week" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta <= 29030400)
        {
            // Month
            $time = floor($delta / 2419200);
            $duration = $time . " month" . (($time > 1) ? "s" : "") . " ago";
        }
        else
        {
            // Years
            $time = floor($delta / 29030400);
            $duration = $time . " year" . (($time > 1) ? "s" : "") . " ago";
        }

        return $duration;
    }

    public function getName()
    {
        return 'blog_extension';
    }
}