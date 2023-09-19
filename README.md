# WolfQuest2.5-Multiplayer
Multiplayer support for WolfQuest 2.5.1

## `assets25/WQ_MP_WolfQuest_2_0_0.unity3d`
At launch during multiplayer initialization, WolfQuest makes a request to download this file from <http://wolfquest.org/assets25/WQ_MP_WolfQuest_2_0_0.unity3d>.  It's not clear what this is for, but it is archived here so that a replacement WolfQuest.org web server can serve a copy of the same file.

## `bb/vuser4.php`
After communicating with the Master Server, WolfQuest does one additional check to verify the player-supplied username and password against its bulletin board user list.  The game makes a GET request to <http://www.wolfquest.org/bb/vuser4.php> and passes the (lowercase) username as `uname` and the password (rot13) as `pwd`.  The auth script must respond with a lowercase-hex-md5 of the result: "No such user", "User $uname found, wrong password" or "User $uname does exist".

Any non-200 response code (including 301/302 Redirect) is considered an error in contacting the auth server, so the script can't be moved to HTTPS or pointed to another server.

An example PHP script, which always returns success if `uname` is nonblank, is provided in the `web/` folder.

## Unity Networking Servers
This repository contains modified versions of the RakNet-based Unity Networking Servers for Unity 3.x.  The source code was obtained from <https://unity3d.com/master-server> and mirrored here.  WolfQuest 2.5.1 is built on Unity 3.4.1f5 and uses these services to find player-hosted games.

Modifications to the code are based on [this Unity forum thread](https://discussions.unity.com/t/unity-master-server-ubuntu-build-problem/67603/4), which allows building on Linux with a newer C compiler.

### Network Details
Some hints about the Networking Servers:

* **Master Server**
  This is fairly self-explanatory: binds to a single UDP port (default 23466), accepts server registrations, and sends the list to clients on demand.

* **Connection Tester**
  Connection Tester is a tool for helping identify what form of NAT a client might be using.  Its operation is described somewhat in [the RakNet documentation](http://www.raknet.net/raknet/manual/natpunchthrough.html).  In order to work correctly, **it requires 4 IP addresses** (at least 2 public and fixed, the other 2 may be virtual / shared).  The general theory is that it takes a message from a client on one fixed IP (UDP port 10737), then sends a response on a second (fixed or dynamic) one, and the client's behavior can be used to determine what sort of NAT, if any, is in use.  The probe happens twice, hence four IPs total.

  If you don't have four IP addresses, edit line 256 and change `if (ipCount < 4)` to `if (ipCount < 1)`, then run the server and bind the same address multiple times, as in `./ConnTester -h 0.0.0.0 -b 0.0.0.0 0.0.0.0 0.0.0.0`.  This will work for non-NAT player servers, but obviously detection of NAT type will no longer work.

* **Facilitator / Proxy Server**
  Required for doing NAT punchthrough, both parties must be connected to the same Facilitator.  Proxy Server can be used for proxying traffic from clients to servers they otherwise could not connect to.  The two work together, though I am not sure how: WolfQuest made a DNS query to the Facilitator address but I have never seen it actually use these services.

For more information see the [Master Server Build](https://docs.unity3d.com/2018.1/Documentation/Manual/net-MasterServer.html) manual page.
