<?php
class Object
{
    public $SubjectId;
    public $GradeId;
    public $SubjectName;
    public $GradeName;
    public $SubjectAction;
    public $GradeAction;
    function _construct()
    {
        
    }
    function setSubjectAction($SubjectAction)
    {
        $this->SubjectAction = $SubjectAction;
    }
    function setGradeAction($GradeAction)
    {
        $this->GradeAction = $GradeAction;
    }
    function setSubjectId($SubjectId)
    {
        $this->SubjectId=$SubjectId;
    }
    function setGradeId($GradeId)
    {
        $this->GradeId=$GradeId;
    }
    function setSubjectName($SubjectName)
    {
        $this->SubjectName=$SubjectName;
    }
    function setGradeName($GradeName)
    {
        $this->GradeName=$GradeName;
    }
    function getSubjectId()
    {
        return $this->SubjectId;
    }
    function getGradeId()
    {
        return $this->GradeId;
    }
    function getSubjectName()
    {
        return $this->SubjectName;
    }
    function getGradeName()
    {
        return $this->GradeName;
    }
    function getSubjectAction()
    {
        return $this->SubjectAction;
    }
    function getGradeAction()
    {
        return $this->GradeAction;
    }
    function getAll()
    {
        return $this->SubjectId."\t".$this->GradeId."\t".$this->SubjectName."\t".$this->GradeName."\t".$this->SubjectAction."\t".$this->GradeAction;
    }
}
?>