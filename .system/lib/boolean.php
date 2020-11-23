<?php

    class boolean
    {
        public function checkNull()
        {
            $vals = func_get_args();
            $bool = true;
            foreach($vals as $val)
            {
                $bool = (($val == NULL) || ($val == '')) ? false : true;
                if($bool == false)
                    break;
            }
            return $bool;
        }

    }

?>