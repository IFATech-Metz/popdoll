<?php

function recur_sort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_sort($value,$flag);
  return sort($array,$flag);
}
function recur_rsort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_rsort($value,$flag);
  return rsort($array,$flag);
}
function recur_ksort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_ksort($value);
  return ksort($array);
}
function recur_krsort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_krsort($value,$flag);
  return krsort($array,$flag);
}
function recur_asort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_asort($value,$flag);
  return asort($array,$flag);
}
function recur_arsort(&$array,$flag=null) {
  foreach ($array as &$value) if (is_array($value)) recur_arsort($value,$flag);
  return arsort($array,$flag);
}
function recur_natsort(&$array) {
  foreach ($array as &$value) if (is_array($value)) recur_natsort($value);
  return natsort($array);
}
function recur_natcasesort(&$array) {
  foreach ($array as &$value) if (is_array($value)) recur_natcasesort($value);
  return natcasesort($array);
}
