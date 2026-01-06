<?php

class Solution {

    /**
     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */
    function isSameTree($p, $q) {
        if(!$p && !$q)
            return true;

        if(!$p or !$q)
            return false;

        return (($p->val == $q->val) && ($this->isSameTree($p->left, $q->left)) && ($this->isSameTree($q->right, $p->right)));
    }
}