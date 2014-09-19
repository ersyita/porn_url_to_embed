<?php

class Porn_URL
{
    const URL_XVIDEOS = 'xvideos.com';
    const EMBED_XVIDEOS = 'http://flashservice.xvideos.com/embedframe/';
    
    const URL_REDTUBE = 'redtube.com';
    const EMBED_REDTUBE = 'http://embed.redtube.com/?id=_XXX_&bgcolor=000000';
    
    const URL_PORNHUB = 'pornhub.com';
    const EMBED_PORNHUB = 'http://www.pornhub.com/embed/';
    
    const URL_YOUPORN = 'youporn.com';
    const EMBED_YOUPORN = 'http://www.youporn.com/embed/';
    
    const URL_ZBPORN = 'zbporn.com';
    const EMBED_ZBPORN = 'http://zbporn.com/embed/';
    
    const URL_TNAFLIX = 'tnaflix.com';
    const EMBED_TNAFLIX = 'http://player.tnaflix.com/video/';
    
    const URL_TUBE8 = 'tube8.com';
    const EMBED_TUBE8 = 'http://www.tube8.com/embed/xxx/xxx/';
    
    const URL_YOUJIZZ = 'youjizz.com';
    const EMBED_YOUJIZZ = 'http://www.youjizz.com/videos/embed/';
    
    const URL_DRTUBER = 'drtuber.com';
    const EMBED_DRTUBER = 'http://www.drtuber.com/embed/';
    
    const URL_SLUTLOAD = 'slutload.com';
    const EMBED_SLUTLOAD = 'http://www.slutload.com/embed_player/';
    
    public static function getBaseUrls()
    {
        $reflection = new ReflectionClass(__CLASS__);
        
        $constants = $reflection->getConstants();
        
        $base_urls = array();
        
        foreach($constants as $key => $contant)
            if(strpos($key, 'URL') !== false)
                $base_urls[$key] = $contant;
            
        return $base_urls;
    }
    
    public static function getEmbed($url)
    {
        foreach(self::getBaseUrls() as $key => $base_url)
        {
            if(strpos($url, $base_url) !== false)
            {
                $pieces = explode('_', $key);
                $method = "getEmbed_{$pieces[1]}";
                
                return self::$method($url);
            }
        }
        
        return false;
    }
    
    protected static function getEmbed_XVIDEOS($url)
    {
        preg_match('/(video[0-9])\w+/', $url, $matches);
        return $matches ? self::EMBED_XVIDEOS . str_replace('video', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_REDTUBE($url)
    {
        preg_match('/[0-9]\w+/', $url, $matches);
        return $matches ? str_replace('_XXX_', $matches[0], self::EMBED_REDTUBE) : false;
    }
    
    protected static function getEmbed_PORNHUB($url)
    {
        preg_match('/[0-9]\w+/', $url, $matches);
        return $matches ? self::EMBED_PORNHUB . $matches[0] : false;
    }
    
    protected static function getEmbed_YOUPORN($url)
    {
        preg_match('/watch\/[0-9]\w+/', $url, $matches);
        return $matches ? self::EMBED_YOUPORN . str_replace('watch/', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_ZBPORN($url)
    {
        preg_match('/videos\/[0-9]\w+/', $url, $matches);
        return $matches ? self::EMBED_ZBPORN . str_replace('videos/', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_TNAFLIX($url)
    {
        preg_match('/(video[0-9])\w+/', $url, $matches);
        return $matches ? self::EMBED_TNAFLIX . str_replace('video', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_YOUJIZZ($url)
    {
        preg_match('/([0-9])\w+.html/', $url, $matches);
        return $matches ? self::EMBED_YOUJIZZ . str_replace('.html', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_TUBE8($url)
    {
        $id = end(array_filter(explode('/', $url)));
        return $id && is_numeric($id) ? self::EMBED_TUBE8 . $id : false;
    }
    
    protected static function getEmbed_DRTUBER($url)
    {
        preg_match('/video\/[0-9]\w+/', $url, $matches);
        return $matches ? self::EMBED_DRTUBER. str_replace('video/', '', $matches[0]) : false;
    }
    
    protected static function getEmbed_SLUTLOAD($url)
    {
        $id = end(array_filter(explode('/', $url)));
        return $id ? self::EMBED_SLUTLOAD . $id : false;
    }
}