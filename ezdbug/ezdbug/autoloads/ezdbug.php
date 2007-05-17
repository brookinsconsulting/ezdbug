<?php
//
// Created on: <12-Jan-2007 12:57:54 gb>
//
// Copyright (C) 2001-2006 Brookins Consulting. All rights reserved.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 or greater as published by the Free
// Software Foundation and appearing in the file LICENSE.GPL included in
// the packaging of this file.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@brookinsconsulting.com if any conditions of
// this licencing isn't clear to you.
//


// Note: This is a static incomplete key of the log
// file features ... Ready for replacement with ezlog

// If EZDBUG is false, no debug output will be displayed.
define('EZDBUG', true);
define('EZDBUG_LOG_DIR', 'logs');

include_once( 'lib/ezutils/classes/ezini.php' );
include_once( 'extension/ezdbug/classes/ezdbug.php' );

class eZDBugOperators
{
    /*!
     Constructor
    */
    function eZDBugOperators()
    {
        $this->Operators = array( 'ezdbug', 'ezdbug_dump' );
        $this->Debug = false;
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list
    exists per operator type, this is needed for operator classes
    that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {
        return array( 'ezdbug' => array( 'var' => array( 'type' => 'array', 'required' => true, 'default' => '' ),
                                         'depth' => array( 'type' => 'number', 'required' => false, 'default' => '99' ),
                                         'show_functions' => array( 'type' => 'bool', 'required' => false, 'default' => false )
                                         ),
                      'ezdbug_dump' => array( 'var' => array( 'type' => 'array', 'required' => true, 'default' => '' ),
                                         'depth' => array( 'type' => 'number', 'required' => false, 'default' => '99' ),
                                         'show_functions' => array( 'type' => 'bool', 'required' => false, 'default' => false )
                                         )
                      );
    }

    /*!
     \Executes the needed operator(s).
     \Checks operator names, and calls the appropriate functions.
    */
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace,
                     &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'ezdbug':
            case 'ezdbug_dump':
            {
                $operatorValue = $this->ezdbugDump( $namedParameters['var'], $namedParameters['depth'], $namedParameters['show_functions'] );
            }
            break;
        }
    }

    /*!
     \Outputs the data for given arguments.
    */
    function ezdbugDump( $v, $max_depth = 2, $show_functions = false )
    {
        $GLOBALS['__ezDbugMaxDepth'] = $max_depth;
        $GLOBALS['__ezDbugShowFunctions'] = $show_functions;
        if ( $v )
        {
            eZDebug::writeNotice( 'eZDBug::Dump : Output Enabled', $v);
        } else {
            eZDebug::writeError( 'eZDBug::Dump', $v );
        }

        ezDbugDump($v);
    }

    /// \privatesection
    var $Operators;
    var $Debug;
}

?>