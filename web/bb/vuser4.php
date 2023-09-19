<?php
  /* USER AUTH FOR WOLFQUEST
   *
   * WolfQuest sends a GET request to this PHP script with two URL parameters:
   *  uname: the username to check for authorization (lowercase)
   *  pwd:   the user's password, with all alpha characters rot13-encoded
   *
   * The Auth page is supposed to check the bulletin-board user list and return
   *  a lowercase, 32-byte hex string md5 digest of one of the following phrases,
   *  where $uname contains the username (above).
   *
   * "No such user"
   *  username not found in the DB (125c4d20d02ef5b3d0fbf7f11bf1acd5)
   * "User $uname found, wrong password"
   *  username was found but the password was incorrect
   * "User $uname does exist"
   *  Auth succeeded
   * <HTTP error or 10-second timeout>
   *  Auth server / user database is down
   *
   * Note that any non-200 result is considered an error - including a 301/302
   *  Redirect to SSL or a www. prefix - so the auth server MUST be exactly at
   * http://wolfquest.org/bb/vuser4.php
   *
   * For this proof of concept, no actual authorization is done and the password
   *  is not checked: every non-blank username is returned as a successful login.
   */
  header("Content-Type: text/plain");

  if (isset($_GET['uname'])) {
    echo md5("User " . $_GET['uname'] . " does exist");
  } else {
    echo md5("No such user");
  }

  exit;
?>
