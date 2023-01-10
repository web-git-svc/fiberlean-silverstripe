<!DOCTYPE html>
<html lang="{$ContentLocale}">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="//www.google-analytics.com" rel="dns-prefetch" />
	<link rel="stylesheet" href="https://use.typekit.net/gpv2hcx.css">

	<title><% if $MetaTitle %>{$MetaTitle.XML}<% else %>{$Title.XML} | {$SiteConfig.Title}<% end_if %></title>
	<% base_tag %>
	{$MetaTags(false)}
	{$SiteConfig.StartOfHead.RAW}
	<% require themedCSS('dist/css/style') %>
	<% include App\Includes\OpenGraph %>
	{$SiteConfig.EndOfHead.RAW}
</head>
<body class="{$ClassName.ShortName.LowerCase}">
{$SiteConfig.StartOfBody.RAW}

<div class="viewport">
	<%-- Move to include --%>
	<svg style="position: absolute; width: 0; height: 0;">
		<clipPath id="curved-image-clip-path" clipPathUnits="objectBoundingBox"><path d="M1,0.137 C0.556,-0.148,0.091,0.092,0,0.144 V1 H1 V0.137"></path></clipPath>
	</svg>

	<svg style="position: absolute; width: 0; height: 0;">
		<clipPath id="intro-block-clip-path" clipPathUnits="objectBoundingBox"><path d="M0,1 h1 V0 C0.747,0.069,0.066,0.318,0,1"></path></clipPath>
	</svg>


	<% include App\Includes\Header %>

	{$Layout}

	<% include App\Includes\Footer %>

</div>

{$SiteConfig.EndOfBody.RAW}
</body>
</html>
