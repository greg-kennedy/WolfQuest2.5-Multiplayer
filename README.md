# WolfQuest2.5-Multiplayer
Multiplayer support for WolfQuest 2.5.1

## `assets25/WQ_MP_WolfQuest_2_0_0.unity3d`
At launch during multiplayer initialization, WolfQuest makes a request to download this file from <http://wolfquest.org/assets25/WQ_MP_WolfQuest_2_0_0.unity3d>.  It's not clear what this is for, but it is archived here so that a replacement WolfQuest.org web server can serve a copy of the same file.

## Unity Networking Servers
This repository contains an unmodified version of the RakNet-based Unity Networking Servers for Unity 3.x.  The source code was obtained from <https://unity3d.com/master-server> and mirrored here.  WolfQuest 2.5.1 is built on Unity 3.4.1f5 and uses these services to find player-hosted games.

### Network Details
This is where you can download the latest source code for the Unity builtin networking servers. The current version is 2.0.1f1 (Unity 3.x compatible):

* **Master Server**
  For use with the MasterServer.* API.

* **Facilitator**
  Required for doing NAT punchthrough, both parties must be connected to the same Facilitator.

* **Connection Tester**
  Required for performing connection tests, it needs to be hosted on a server with 4 unique IP addresses.

* **Proxy Server**
  Used for proxing traffic from clients to servers they otherwise could not connect to, be aware that this adds a lot of latency to the traffic.

For more information see the [Master Server Build](https://docs.unity3d.com/2018.1/Documentation/Manual/net-MasterServer.html) manual page.
