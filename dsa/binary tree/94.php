<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    function inorderTraversal($root) {
        $result = [];

        $this->recursivly($root, $result);
        return $result;
    }
    function recursivly($node, &$result){
        if($node){
            $this->recursivly($node->left, $result);
            $result[] = $node->val;
            $this->recursivly($node->right, $result);
        }
    }
}