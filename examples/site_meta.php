<?php
/**
 * Site metadata configuration and description generator.
 * This file provides structured metadata for a website.
 */

/**
 * Retrieves the base metadata array for the site.
 *
 * @return array
 */
function getSiteMetadata(): array
{
    return [
        'title'       => '爱游戏中心',
        'domain'      => 'https://zhportal-aiyouxi.com.cn',
        'description' => '提供各类爱游戏资讯与攻略',
        'keywords'    => ['爱游戏', '游戏资讯', '攻略'],
        'version'     => '2.1.0',
        'locale'      => 'zh_CN',
        'author'      => 'Portal Team',
        'copyright'   => '© 2025 Aiyouxi Portal',
    ];
}

/**
 * Generates a short description string based on metadata and optional extra info.
 *
 * @param array  $meta   Site metadata array.
 * @param string $extra  Optional extra context string.
 * @return string
 */
function generateShortDescription(array $meta, string $extra = ''): string
{
    $parts = [
        $meta['title'] ?? '未知站点',
        $meta['description'] ?? '',
    ];

    if (!empty($extra)) {
        $parts[] = $extra;
    }

    $base = implode(' — ', array_filter($parts));

    $keywordStr = '';
    if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
        $keywordStr = implode(', ', array_slice($meta['keywords'], 0, 3));
    }

    if ($keywordStr !== '') {
        $base .= ' | 关键词：' . $keywordStr;
    }

    $base .= ' | ' . ($meta['domain'] ?? '无域名');

    return htmlspecialchars($base, ENT_QUOTES, 'UTF-8');
}

/**
 * Returns a formatted summary block for display.
 *
 * @param array $meta
 * @return string
 */
function renderMetaSummary(array $meta): string
{
    $desc = generateShortDescription($meta);
    $version = $meta['version'] ?? '0.0.0';
    $locale = $meta['locale'] ?? 'unknown';

    return sprintf(
        "[%s] %s (v%s, %s)",
        $locale,
        $desc,
        htmlspecialchars($version, ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($meta['domain'] ?? '', ENT_QUOTES, 'UTF-8')
    );
}

// --- Example usage ---

$siteMeta = getSiteMetadata();

$descText = generateShortDescription($siteMeta, '专注于爱游戏内容');

echo "Short description:\n";
echo $descText . "\n\n";

echo "Summary block:\n";
echo renderMetaSummary($siteMeta) . "\n";

// Additional usage: pass custom extra info
$descWithExtra = generateShortDescription($siteMeta, '每日更新');
echo "\nWith extra info:\n";
echo $descWithExtra . "\n";