<?php //$Id: /catalog/admin/includes/functions/password_funcs_create_account.php (5388) 

// FUNCTION MOVED TO general.php BECAUSE FUNCTION ALSO EXIST IN password_funcs.php \\
////
// This function validates a plain text password with an
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
  function tep_encrypt_password_for_create_account($plain) {
    $password = '';

    for ($i=0; $i<10; $i++) {
      $password .= tep_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }
?>
