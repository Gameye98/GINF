#!/usr/bin/env php
<?php
/* GINF - GitHub Information Gathering
 * author: DedSecTL
 * telegram: @dtlily
 * line: dtl.lily
 * team: BlackHole Security
 */
$red = "\033[1;31m";
$yellow = "\033[1;33m";
$whiteBold = "\033[1;97m";
$white = "\033[97m";
$cyan = "\033[96m";
$cyanBold = "\033[1;96m";
$normal = "\033[0m";
$ua = "Mozilla/5.0 (Linux; Android 5.1.1; Andromax A16C3H Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.111 Mobile Safari/537.36";
$banner = "$cyanBold        ___   ___   _  _   ___
$cyanBold       / __| |_ _| | \| | | __|$whiteBold  /\_/\
$cyanBold      | (_ |  | |  | .` | | _|$whiteBold  (•. • )
$cyanBold       \___| |___| |_|\_| |_|$whiteBold    (___)~*$normal\n";
$about = "$white
About
-----
GINF - Github Information Gathering
Author : DedSecTL <dtlily>
Version : 1.0
Team : BlackHole Security
Date : Fri Aug 17 07:48:19 2018
Telegram : @dtlily
Line : dtl.lily$normal\n\n";
$help = "$white
Command         Description
-------         -----------$cyan
clear$white           clear the screen$cyan
banner$white          show banner$cyan
getuser$white         get user information$cyan
getrepos$white        get repos information$cyan
getfower$white        get follower information$cyan
getfowin$white        get following information$cyan
about$white           about this program$cyan
exit$white            exit the ginf$normal\n\n";
echo $banner;
echo "$whiteBold       Type $cyanBold'help'$whiteBold for more information$normal\n\n";
while (True) {
	$userInput = readline($cyanBold."ginf$white> ");
	readline_add_history($userInput);
	if($userInput == "help") {
		echo $help;
	} elseif($userInput == "clear") {
		system("clear");
	} elseif($userInput == "banner") {
		echo $banner."\n";
	} elseif($userInput == "getuser") {
		echo "Usage: getuser <username>\n";
	} elseif($userInput == "getrepos") {
		echo "Usage: getrepos <username> [<reponame>]\n";
	} elseif($userInput == "getfower") {
		echo "Usage: getfower <username>\n";
	} elseif($userInput == "getfowin") {
		echo "Usage: getfowin <username>\n";
	} elseif(preg_match('/getuser/', $userInput)) {
		if(explode(' ', $userInput)[0] == "getuser" && count(explode(' ', $userInput)) == 2) {
			$url = "https://api.github.com/users/".explode(' ', $userInput)[1];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
			$res = curl_exec($ch);
			curl_close($ch);
			if($res != NULL && count(explode(' ', $res)) != 1) {
				$data = json_decode($res, 1);
				echo "\n[+] User Information\n";
				echo "login: ".$data["login"]."\n";
				echo "id: ".$data["id"]."\n";
				echo "node id: ".$data["node_id"]."\n";
				echo "avatar url: ".$data["avatar_url"]."\n";
				echo "gravatar id: ".$data["gravatar_id"]."\n";
				echo "url: ".$data["url"]."\n";
				echo "html url: ".$data["html_url"]."\n";
				echo "type: ".$data["type"]."\n";
				echo "site admin: ".$data["site_admin"]."\n";
				echo "name: ".$data["name"]."\n";
				echo "company: ".$data["company"]."\n";
				echo "blog: ".$data["blog"]."\n";
				echo "location: ".$data["location"]."\n";
				echo "email: ".$data["email"]."\n";
				echo "hireable: ".$data["hireable"]."\n";
				echo "bio: ".$data["bio"]."\n";
				echo "public repos: ".$data["public_repos"]."\n";
				echo "public gists: ".$data["public_gists"]."\n";
				echo "followers: ".$data["followers"]."\n";
				echo "following: ".$data["following"]."\n";
				echo "created at: ".$data["created_at"]."\n";
				echo "updated at: ".$data["updated_at"]."\n\n";
			} else {
				echo "[!] NetworkError: network is unreachable\n";
			}
		} else {
			//pass
		}
	} elseif(preg_match('/getrepos/', $userInput)) {
		if(explode(' ', $userInput)[0] == "getrepos" && count(explode(' ', $userInput)) == 2) {
			$url = "https://api.github.com/users/".explode(' ', $userInput)[1]."/repos?per_page=999";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
			$res = curl_exec($ch);
			curl_close($ch);
			if($res != NULL && count(explode(' ', $res)) != 1) {
				$data = json_decode($res, 1);
				echo "\n[+] Repos Information\n";
				for($x = 0;$x < count($data);$x++) {
					echo "id: ".$data[$x]["id"]."\n";
					echo "node id: ".$data[$x]["node_id"]."\n";
					echo "name: ".$data[$x]["name"]."\n";
					echo "full name: ".$data[$x]["full_name"]."\n";
					echo "owner: ".$data[$x]["owner"]["login"]."\n";
					echo "private: ".$data[$x]["private"]."\n";
					echo "html url: ".$data[$x]["html_url"]."\n";
					echo "description: ".$data[$x]["description"]."\n";
					echo "fork: ".$data[$x]["fork"]."\n";
					echo "homepage: ".$data[$x]["homepage"]."\n";
					echo "size: ".$data[$x]["size"]."\n";
					echo "startgazer(s): ".$data[$x]["startgazers_count"]."\n";
					echo "watcher(s): ".$data[$x]["watchers"]."\n";
					echo "language: ".$data[$x]["language"]."\n";
					echo "issues: ".$data[$x]["has_issues"]."\n";
					echo "projects: ".$data[$x]["has_projects"]."\n";
					echo "downloads: ".$data[$x]["has_downloads"]."\n";
					echo "wiki: ".$data[$x]["has_wiki"]."\n";
					echo "pages: ".$data[$x]["has_pages"]."\n";
					echo "mirror url: ".$data[$x]["mirror_url"]."\n";
					echo "archived: ".$data[$x]["archived"]."\n";
					echo "license: ".$data[$x]["license"]."\n";
					echo "forks: ".$data[$x]["forks"]."\n";
					echo "open issues: ".$data[$x]["open_issues"]."\n";
					echo "default branch: ".$data[$x]["default_branch"]."\n\n";
				}
			} else {
				echo "[!] NetworkError: network is unreachable\n";
			}
		} elseif(explode(' ', $userInput)[0] == "getrepos" && count(explode(' ', $userInput)) == 3) {
			$url = "https://api.github.com/users/".explode(' ', $userInput)[1]."/repos?per_page=999";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
			$res = curl_exec($ch);
			curl_close($ch);
			if($res != NULL && count(explode(' ', $res)) != 1) {
				$data = json_decode($res, 1);
				echo "\n[+] Repos Information\n";
				for($x = 0;$x < count($data);$x++) {
					if($data[$x]["name"] == explode(' ', $userInput)[2]) {
						echo "id: ".$data[$x]["id"]."\n";
						echo "node id: ".$data[$x]["node_id"]."\n";
						echo "name: ".$data[$x]["name"]."\n";
						echo "full name: ".$data[$x]["full_name"]."\n";
						echo "owner: ".$data[$x]["owner"]["login"]."\n";
						echo "private: ".$data[$x]["private"]."\n";
						echo "html url: ".$data[$x]["html_url"]."\n";
						echo "description: ".$data[$x]["description"]."\n";
						echo "fork: ".$data[$x]["fork"]."\n";
						echo "homepage: ".$data[$x]["homepage"]."\n";
						echo "size: ".$data[$x]["size"]."\n";
						echo "startgazer(s): ".$data[$x]["startgazers_count"]."\n";
						echo "watcher(s): ".$data[$x]["watchers"]."\n";
						echo "language: ".$data[$x]["language"]."\n";
						echo "issues: ".$data[$x]["has_issues"]."\n";
						echo "projects: ".$data[$x]["has_projects"]."\n";
						echo "downloads: ".$data[$x]["has_downloads"]."\n";
						echo "wiki: ".$data[$x]["has_wiki"]."\n";
						echo "pages: ".$data[$x]["has_pages"]."\n";
						echo "mirror url: ".$data[$x]["mirror_url"]."\n";
						echo "archived: ".$data[$x]["archived"]."\n";
						echo "license: ".$data[$x]["license"]."\n";
						echo "forks: ".$data[$x]["forks"]."\n";
						echo "open issues: ".$data[$x]["open_issues"]."\n";
						echo "default branch: ".$data[$x]["default_branch"]."\n\n";
					}
				}
			} else {
				echo "[!] NetworkError: network is unreachable\n";
			}
		} else {
			//pass
		}
	} elseif(preg_match('/getfower/', $userInput)) {
		if(explode(' ', $userInput)[0] == "getfower" && count(explode(' ', $userInput)) == 2) {
			$url = "https://api.github.com/users/".explode(' ', $userInput)[1]."/followers?per_page=999";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
			$res = curl_exec($ch);
			curl_close($ch);
			if($res != NULL && count(explode(' ', $res)) != 1) {
				$data = json_decode($res, 1);
				echo "\n[+] Followers Information\n";
				for($x = 0;$x < count($data);$x++) {
					echo "login: ".$data[$x]["login"]."\n";
					echo "id: ".$data[$x]["id"]."\n";
					echo "node id: ".$data[$x]["node_id"]."\n";
					echo "avatar url: ".$data[$x]["avatar_url"]."\n";
					echo "gravatar id: ".$data[$x]["gravatar_id"]."\n";
					echo "html url: ".$data[$x]["html_url"]."\n";
					echo "type: ".$data[$x]["type"]."\n";
					echo "site admin: ".$data[$x]["site_admin"]."\n\n";
				}
			} else {
				echo "[!] NetworkError: network is unreachable\n";
			}
		} else {
			//pass
		}
	} elseif(preg_match('/getfowin/', $userInput)) {
		if(explode(' ', $userInput)[0] == "getfowin" && count(explode(' ', $userInput)) == 2) {
			$url = "https://api.github.com/users/".explode(' ', $userInput)[1]."/following?per_page=999";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
			$res = curl_exec($ch);
			curl_close($ch);
			if($res != NULL && count(explode(' ', $res)) != 1) {
				$data = json_decode($res, 1);
				echo "\n[+] Following Information\n";
				for($x = 0;$x < count($data);$x++) {
					echo "login: ".$data[$x]["login"]."\n";
					echo "id: ".$data[$x]["id"]."\n";
					echo "node id: ".$data[$x]["node_id"]."\n";
					echo "avatar url: ".$data[$x]["avatar_url"]."\n";
					echo "gravatar id: ".$data[$x]["gravatar_id"]."\n";
					echo "html url: ".$data[$x]["html_url"]."\n";
					echo "type: ".$data[$x]["type"]."\n";
					echo "site admin: ".$data[$x]["site_admin"]."\n\n";
				}
			} else {
				echo "[!] NetworkError: network is unreachable\n";
			}
		} else {
			//pass
		}
	} elseif($userInput == "about") {
		echo $about;
	} elseif($userInput == "exit" || $userInput == "quit") {
		echo $normal;break;
	} else {
		//pass
	}
}