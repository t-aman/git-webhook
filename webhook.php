<?php

/*!-----------------------------------------------------------------
 * GitHubからの自動反映
 * ------------------------------------------------------------------
 */

// SECRET設定、ログ設定
define("WEBHOOK_SECRET", '【Webhook画面のSECRET値】');
define("WEBHOOK_LOGFILE", __DIR__ . '/webhook.log');

// ブランチごとのコマンド
$command = array(
    'refs/heads/master'  => 'git pull --rebase origin master',
    'refs/heads/develop' => 'cd ./develop;git pull --rebase origin develop',
);

// 関数定義（ログ出力）
function putLog($message)
{
    echo date("Y-m-d H:i:s")  . "\t" . $_SERVER['REMOTE_ADDR'] . "\t" . $message . "<br/>";
    error_log(date("Y-m-d H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\t" . $message . "\r\n", 3, WEBHOOK_LOGFILE);
}


/*!------------------------------------------------
 * 自動反映処理
 * ------------------------------------------------
 */
$header    = getallheaders();
$hmac      = hash_hmac('sha1', $HTTP_RAW_POST_DATA, WEBHOOK_SECRET);

if (isset($header['X-Hub-Signature']) && $header['X-Hub-Signature'] === "sha1={$hmac}") {
    $payload = json_decode($HTTP_RAW_POST_DATA, true);
    foreach ($command as $branch => $cmd) {
        if ($payload['ref'] == $branch) {
            if ($cmd !== '') {
                exec($cmd);
                putLog('【PULL】' . "\t" . "{$branch}" . "\t" . "{$payload['commits'][0]['message']}");
            } else {
                putLog('【NULL】' . "\t" . "{$branch}" . "\t" . "{$payload['commits'][0]['message']}");
            }
        }
    }
} else {
    putLog('【ERR】' . "\t" . var_export($header, true) . "\t" . var_export($hmac, true));
}
