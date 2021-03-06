<?php

/*
 * AbstractParameters
 */

namespace Navitia\Component\Request\Parameters;

/**
 * Description of AbstractParameters
 *
 * @author rndiaye
 */
abstract class AbstractParameters implements ParametersInterface
{
    public function getParams()
    {
        $properties = get_object_vars($this);
        $params = array();
        foreach ($properties as $name => $value) {
            if ($value !== null) {
                $params[$name] = $value;
            }
        }
        return $params;
    }
}
