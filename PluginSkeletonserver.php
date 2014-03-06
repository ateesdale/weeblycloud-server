<?php
require_once 'modules/admin/models/ServerPlugin.php';
/**
* @package Plugins
*/
class PluginSkeletonserver extends ServerPlugin
{
    public $usesPackageName = true;
    /*****************************************************************/
    // function getVariables - required function
    /*****************************************************************/

    function getVariables(){
        /* Specification
              itemkey     - used to identify variable in your other functions
              type        - text,textarea,yesno,password
              description - description of the variable, displayed in ClientExec
              encryptable - used to indicate the variable's value must be encrypted in the database
        */


        $variables = array (
                   /*T*/"Name"/*/T*/ => array (
                                        "type"=>"hidden",
                                        "description"=>"Used By CE to show plugin",
                                        "value"=>"Skeleton Plugin"
                                       ),
                   /*T*/"Description"/*/T*/ => array (
                                        "type"=>"hidden",
                                        "description"=>/*T*/"Description viewable by admin in server settings"/*/T*/,
                                        "value"=>/*T*/"Skeleton Plugin, to be used as a base for your custom server plugins."/*/T*/
                                       ),
                   /*T*/"Username"/*/T*/ => array (
                                        "type"=>"text",
                                        "description"=>/*T*/"Username used to connect to server"/*/T*/,
                                        "value"=>""
                                       ),
                   /*T*/"Password"/*/T*/ => array (
                                        "type"=>"password",
                                        "description"=>/*T*/"Password used to connect to server"/*/T*/,
                                        "value"=>"",
                                        "encryptable"=>true
                                       ),
                   /*T*/"Actions"/*/T*/ => array (
                                        "type"=>"hidden",
                                        "description"=>/*T*/"Current actions that are active for this plugin per server"/*/T*/,
                                        "value"=>"Create,Delete,Suspend,UnSuspend"
                                       ),
                   /*T*/'package_vars_values'/*/T*/ => array(
                                        'type'        => 'hidden',
                                        'description' => /*T*/'VM account parameters'/*/T*/,
                                        'value'       => array(
                                            // VIRTUAL MACHINE PROPERTIES
                                            // Template
                                            'template' => array(
                                                'type'        => 'dropdown',
                                                'multiple'    => false,
                                                'getValues'   => 'getTestValues',
                                                'label'       => /*T*/'Template'/*/T*/,
                                                'description' => /*T*/'A Template is a pre-configured OS image that you can build a Virtual Machine on.'/*/T*/,
                                                'value'       => '',
                                            )
                                        ))
        );
        return $variables;
    }

    public function getTestValues()
    {
        $returnValues = array();
        $returnValues[] = array("0","somename-0");
        $returnValues[] = array("1","somename-1");
        $returnValues[] = array("2","somename-2");
        return $returnValues;
    }

    function create($args){
    }

    function update($args){
    }

    function delete($args){
    }

    function suspend($args){
    }

    function unsuspend($args){
    }

    function getAvailableActions($userPackage)
    {
        $actions[] = 'Create';
        $actions[] = 'Delete';
        $actions[] = 'UnSuspend';
        $actions[] = 'Suspend';
        return $actions;
    }

    function doCreate($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $this->create($this->buildParams($userPackage));
        return $userPackage->getCustomField("Domain Name") .  ' has been created.';
    }

    function doSuspend($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $this->suspend($this->buildParams($userPackage));
        return $userPackage->getCustomField("Domain Name") .  ' has been suspended.';
    }

    function doUnSuspend($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $this->unsuspend($this->buildParams($userPackage));
        return $userPackage->getCustomField("Domain Name") .  ' has been unsuspended.';
    }

    function doDelete($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $this->delete($this->buildParams($userPackage));
        return $userPackage->getCustomField("Domain Name") . ' has been deleted.';
    }
}
?>