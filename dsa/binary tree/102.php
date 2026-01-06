<?php

class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($val = 0, $left = null, $right = null) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Solution {

    /**
     * @param TreeNode $root
     * @return int[][]
     */
    function levelOrder($root) {
        $result = [];

        $this->levelOrderRecursivly($root, 0, $result);

        return $result;
    }

    function levelOrderRecursivly($node, $level, &$result)
    {
        if($node){
            if($level >= count($result)){
                $result[] = [];
            }

            $result[$level][] = $node->val;
            $this->levelOrderRecursivly($node->left, $level+1, $result);
            $this->levelOrderRecursivly($node->right, $level+1, $result);
        }
    }
}