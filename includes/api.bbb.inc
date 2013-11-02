<?php
/**
 *  @file
 *  BigBlueButton - Enables universities and colleges to deliver a high-quality
 *  learning experience.
 *
 *  @author
 *  Stefan Auditor <stefan.auditor@erdfisch.de>
 */

/**
 *  Create Meeting (create)
 *
 *  @param ARRAY $params
 *    Associative array of additional url parameters. Components:
 *    - name: STRING (REQUIRED) A name for the meeting.
 *    - meetingID: STRING A meeting ID that can be used to identify this meeting
 *      by the third party application. This is optional, and if not supplied,
 *      BBB will generate a meeting token that can be used to identify the
 *      meeting.
 *    - attendeePW: STRING The password that will be required for attendees to
 *      join the meeting. This is optional, and if not supplied, BBB will assign
 *      a random password.
 *    - moderatorPW: STRING The password that will be required for moderators to
 *      join the meeting or for certain administrative actions (i.e. ending a
 *      meeting). This is optional, and if not supplied, BBB will assign a
 *      random password.
 *    - welcome: STRING A welcome message that gets displayed on the chat window
 *      when the participant joins. You can include keywords (%%CONFNAME%%,
 *      %%DIALNUM%%, %%CONFNUM%%) which will be substituted automatically. You
 *      can set a default welcome message on bigbluebutton.properties
 *    - dialNumber: STRING The dial access number that participants can call in
 *      using regular phone. You can set a default dial number on
 *      bigbluebutton.properties
 *    - logoutURL: STRING The URL that the BigBlueButton client will go to after
 *      users click the OK button on the 'You have been logged out message'.
 *      This overrides, the value for bigbluebutton.web.loggedOutUrl if defined
 *      in bigbluebutton.properties
 *  @return OBJECT or FALSE
 *    - meetingToken: STRING The internal meeting token assigned by the API for
 *      this meeting. It can be used by subsequent calls for joining or
 *      otherwise modifying a meeting's status.
 *    - meetingID: STRING The meeting ID supplied by the third party app, or
 *      null if none was supplied. If can be used in conjunction with a password
 *      in subsequent calls for joining or otherwise modifying a meeting's
 *      status.
 *    - attendeePW: STRING The password that will be required for attendees to
 *      join the meeting. If you did not supply one, BBB will assign a random
 *      password.
 *    - moderatorPW: STRING The password that will be required for moderators to
 *      join the meeting or for certain administrative actions (i.e. ending a
 *      meeting). If you did not supply one, BBB will assign a random password.
 *
 *  See http://code.google.com/p/bigbluebutton/wiki/API#Create_Meeting_(create)
 */
function bbb_api_create($params = array()) {
  $response = bbb_api_call($params, 'create');
  if (isset($response->returncode) && $response->returncode == 'SUCCESS') {
    unset($response->returncode);
    return $response;
  }
  else {
    return FALSE;
  }
}

/**
 *  Join Meeting (join)
 *
 *  @param ARRAY $params
 *    Associative array of additional url parameters. Components:
 *    - fullName: STRING (REQUIRED) The full name that is to be used to identify
 *      this user to other conference attendees.
 *    - meetingToken: The internal meeting token assigned by the API for this
 *      meeting when it was created. Note that either the meetingToken or the
 *      meetingID along with one of the passwords must be passed into this call
 *      in order to determine which meeting to find.
 *    - meetingID: STRING If you specified a meeting ID when calling create,
 *      then you can use either the generated meeting token or your specified
 *      meeting ID to find meetings. This parameter takes your meeting ID.
 *    - password: STRING The password that this attendee is using. If the
 *      moderator password is supplied, he will be given moderator status (and
 *      the same for attendee password, etc)
 *    - redirectImmediately: BOOLEAN If this is passed as true, then BBB will
 *      not return a URL for you to redirect the user to, but will instead treat
 *      this as an entry URL and will immediately set up the client session and
 *      redirect the user into the conference.
 *      Values can be either a 1 (one) or a 0 (zero), indicating true or false
 *      respectively. Defaults to false.
 *  @return STRING
 *    The URL that the user can be sent to in order to join the meeting. When
 *    they go to this URL, BBB will setup their client session and redirect them
 *    into the conference.
 */
function bbb_api_join($params) {
  $query_string = bbb_api_generate_querystring($params, 'join');
  return BIGBLUEBUTTON_BASE_URL . BIGBLUEBUTTON_JOIN_URL . '?' . $query_string;
}

/**
 *  Is meeting running (isMeetingRunning)
 *
 *  This call enables you to simply check on whether or not a meeting is running
 *  by looking it up with either the token or your ID.
 *
 *  @param ARRAY $params
 *    Associative array of additional url parameters. Components:
 *    - meetingToken: STRING The internal meeting token assigned by the API for
 *      this meeting when it was created.
 *    - meetingID: STRING If you specified a meeting ID when calling create,
 *      then you can use either the generated meeting token or your specified
 *      meeting ID to find meetings. This parameter takes your meeting ID.
 *  @return BOOLEAN
 *    A string of either “true” or “false” that signals whether a meeting with
 *    this ID or token is currently running.
 */
function bbb_api_isMeetingRunning($params) {
  $response = bbb_api_call($params, 'isMeetingRunning');
  if (isset($response->returncode) && $response->returncode == 'SUCCESS') {
    return drupal_strtoupper($response->running) == 'TRUE' ? TRUE : FALSE;
  }
  else {
    if (isset($response->returncode)) {
      watchdog('bigbluebutton', '%message', array('%message' => $response->message), WATCHDOG_ERROR);
    }
    return FALSE;
  }
}

/**
 *  End Meeting (endMeeting)
 *
 *  Use this to forcibly end a meeting and kick all participants out of the
 *  meeting.
 *
 *  @param ARRAY $params
 *    Associative array of additional url parameters. Components:
 *    - meetingToken: STRING The internal meeting token assigned by the API for
 *      this meeting when it was created. Note that either the meetingToken or
 *      the meetingID along with one of the passwords must be passed into this
 *      call in order to determine which meeting to find.
 *    - meetingID: STRING If you specified a meeting ID when calling create,
 *      then you can use either the generated meeting token or your specified
 *      meeting ID to find meetings. This parameter takes your meeting ID.
 *    - password: STRING The moderator password for this meeting. You can not
 *      end a meeting using the attendee password.
 *   @return BOOLEAN
 *     A string of either “true” or “false” that signals whether the meeting was
 *     successfully ended.
 */
// TODO: this call is not yet implemented.
function bbb_api_endMeeting($params) {
  $response = bbb_api_call($params, 'end');
  if (isset($response->returncode) && $response->returncode == 'SUCCESS') {
    unset($response->returncode);
    return $response;
  }
  else {
    return FALSE;
  }
}

/**
 *  Get Meeting Info (getMeetingInfo)
 *
 *  This call will return all of a meeting's information, including the list of
 *  attendees as well as start and end times.
 *
 *  @param ARRY $params
 *    Associative array of additional url parameters. Components:
 *    - meetingToken: STRING The internal meeting token assigned by the API for
 *      this meeting when it was created. Note that either the meetingToken or
 *      the meetingID along with one of the passwords must be passed into this
 *      call in order to determine which meeting to find.
 *    - meetingID: STRING If you specified a meeting ID when calling create,
 *      then you can use either the generated meeting token or your specified
 *      meeting ID to find meetings. This parameter takes your meeting ID.
 *    - password: STRING (REQUIRED) The moderator password for this meeting. You
 *      can not get the meeting information using the attendee password.
 *  @return OBJECT or FALSE
 */
// TODO: this call is not yet implemented.
function bbb_api_getMeetingInfo($params) {
  $response = bbb_api_call($params, 'getMeetingInfo');
  if (isset($response->returncode) && $response->returncode == 'SUCCESS') {
    unset($response->returncode);
    return $response;
  }
  else {
    return FALSE;
  }
}

/* Helper functions */

/**
 * Connect to BBB API and return response.
 *
 * @param $params
 *   Associative array of additional url parameters. See bbb_api_create().
 * @param $call
 *   API call name. Possible values:
 *   - 'create'
 *   - 'isMeetingRunning'
 *   - 'endMeeting'
 *   - 'getMeetingInfo'
 * @return
 *   stdClass response or FALSE if BBB service is not available at given url.
 */
function bbb_api_call($params, $call) {
  $query_string = bbb_api_generate_querystring($params, $call);
  $request = BIGBLUEBUTTON_BASE_URL . '/api/' . $call . '?' . $query_string;
  $xml = @simplexml_load_file($request);
  // If XML is available, parse the API response.
  if (!empty($xml)) {
    $response = bbb_api_parse_response($xml);
    // Check if request was successful.
    if (isset($response->returncode) && $response->returncode == 'SUCCESS') {
      // Everything is OK.
    }
    else {
      // If errors occured, log them.
      if (isset($response->message)) {
        watchdog('bigbluebutton', '%message', array('%message' => $response->message), WATCHDOG_ERROR);
      }
      else {
        watchdog('bigbluebutton', 'BigBlueButton error. API call: %call. Request URL: %url', array('%call' => $call, '%url' => $request), WATCHDOG_ERROR);
      }
    }
    return $response;
  }
  else {
    watchdog('bigbluebutton', 'BigBlueButton service not available. API call: %call. Request URL: %url', array('%call' => $call, '%url' => $request), WATCHDOG_ERROR);
    return FALSE;
  }
}

/**
 *  Generate a signed query string
 */

function bbb_api_generate_querystring($params = array(), $call = '') {
  $query = array();
  // URL encoding the parameters
  foreach ($params as $key => $value) {
    $query[] = $key . '=' . drupal_encode_path(trim($value));
  }
  // Putting it together
  $query_string = implode('&', $query);
  // Adding the checksum to query string and return
  $query_string = $query_string . '&checksum=' . sha1($call . $query_string . BIGBLUEBUTTON_SECURITY_SALT);
  return $query_string;
}

/**
 *  Parse xml response
 *
 *  @param XML
 *  @return OBJECT
 */
function bbb_api_parse_response($xml) {
  //TODO: Refactor
  $response = new StdClass;
  if ($xml) {
    foreach ($xml as $element => $node) {
      $response->$element = (string) $node;
    }
  }
  return $response;
}