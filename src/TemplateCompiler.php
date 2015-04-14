<?php namespace SunMailer; 

class TemplateCompiler {

    /**
     * Compile the template using the given data
     *
     * @param       $view
     * @param array $data
     *
     * @return mixed
     * @throws MailerException
     */
    public static function compile($view, array $data = null)
    {
        preg_match_all('/@+[A-Za-z0-9_-]+/', $view, $matches);

        $dataIsNull = is_null($data);

        if ( ! $dataIsNull)
        {
            $dataKeys = array_keys($data);
        }

        foreach($matches[0] as $match)
        {
            if( (substr($match, 0,2) == '@@') )
            {
                $view =  str_replace( $match, substr($match, 1), $view);
            }
            else
            {
                if ($dataIsNull) throw new MailerException('Variable [ '. substr($match, 1) . ' ] is undefined.');

                $key  = str_replace('@', '', $match );

                if (in_array($key, $dataKeys))
                {
                    if(is_array($data[$key]))
                    {
                        $view = preg_replace( '/'. $match .'/',  self::arrayToString($data[$key]), $view);
                    }
                    else
                    {
                        $view = preg_replace('/'. $match .'/',  $data[$key], $view);
                    }
                }

                else throw new MailerException('Variable [ ' . $key . ' ] is undefined');

            }
        }

        return $view;
    }

    /**
     * To generate array to string
     *
     * @param array $dataArray
     *
     * @return string
     */
    public function arrayToString(array $dataArray)
    {
        $dataString = '[ ';

        foreach($dataArray as $key => $value)
        {
            $dataString .= '\''. $key .'\'';
            $dataString .=  '=>';
            $dataString .= '\''. $value .'\',';
        }

        $dataString = rtrim($dataString, ',') . ' ]';

        return $dataString;
    }
}