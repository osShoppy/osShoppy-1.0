<?php //$Id: /catalog/admin/includes/functions/password_funs.php (osC) 

// FUNCTION MOVED TO general.php BECAUSE FUNCTION ALSO EXIST IN password_funcs_create_account.php \\
////
// This funstion validates a plain text password with an
// encrpyted password
/*  function tep_validate_password($plain, $encrypted) {
    if (tep_not_null($plain) && tep_not_null($encrypted)) {
// split apart the hash / salt
      $stack = explode(':', $encrypted);

      if (sizeof($stack) != 2) return false;

      if (md5($stack[1] . $plain) == $stack[0]) {
        return true;
      }
    }

    return false;
  }
*/
////
// This function makes a new password from a plaintext password. 
  function tep_encrypt_password($plain) {
    $password = '';

    for ($i=0; $i<10; $i++) {
      $password .= tep_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }
?>
