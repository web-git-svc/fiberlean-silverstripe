<!DOCTYPE html>
<html lang="{$ContentLocale}">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link href="//www.google-analytics.com" rel="dns-prefetch"/>

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
		<clipPath id="curved-image-clip-path" clipPathUnits="objectBoundingBox">
			<path d="M1,0.137 C0.556,-0.148,0.091,0.092,0,0.144 V1 H1 V0.137"></path>
		</clipPath>
	</svg>

	<svg style="position: absolute; width: 0; height: 0;">
		<clipPath id="intro-block-clip-path" clipPathUnits="objectBoundingBox">
			<path d="M0,1 h1 V0 C0.747,0.069,0.066,0.318,0,1"></path>
		</clipPath>
	</svg>

	<svg style="position: absolute; width: 0; height: 0;">
		<defs>
			<clipPath id="image-blob-clip">
				<path d="M-15485.362,358.781s777.939,177.572,778.89,1009.1-1575.7,1080.468-1575.7,1080.468Z"
					  transform="translate(16282.169 -358.781)"/>
			</clipPath>
		</defs>
	</svg>

	<svg style="position: absolute; width: 0; height: 0;">
		<clipPath id="circle-quarter" clipPathUnits="objectBoundingBox">
			<path d="M1,1 v-0.003 C0.776,0.189,0.001,0.001,0.001,0.001 v1 H1"></path>
		</clipPath>
	</svg>


	<% include App\Includes\Header %>

	<% with $CurrentVIPArea %>
		{$Breadcrumbs}

		<div class="container typography">
			<h1>
				{$Title}
			</h1>
		</div>
	<% end_with %>

	<div class="bg--grey login__section">
		<div class="container typography">
			<p>
				Get access to exclusive Fiberlean content, login to our VIP area here.
			</p>

			<div class="login__grid">
				<div class="login__column">
					<h2>
						VIP login
					</h2>

					<p>
						Login to your account here.
					</p>

					{$Form}
				</div>

				<div class="login__column">
					<h2>
						Not registered yet?
					</h2>

					<p>
						Fill in the form below to request access.
					</p>

					{$RegisterForm}
				</div>
			</div>
		</div>

		<% if $CurrentVIPArea.LoginImage %>
			<div class="login__left">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 711.9 742"
					 preserveAspectRatio="none">
					<path d="M711.4,0.7C134.1,156.9,0.6,741.5,0.6,741.5h710.7V0.7z" fill="currentColor"/>
				</svg>

				<div class="login__image">
					{$CurrentVIPArea.LoginImage}
				</div>
			</div>
		<% end_if %>
	</div>

	<div class="login__section">
		<div class="container">
			<% with $CurrentVIPArea %>
				<% if $FeatureBoxesTitle %>
					<h2 class="login__bottom-title">
						{$FeatureBoxesTitle}
					</h2>
				<% end_if %>

				<% if $FeatureBoxes %>
					<ul class="login__feature-boxes">
						<% loop $FeatureBoxes %>
							<li>
								<div class="login__feature-box">
									<% if $Image %>
										<div class="login__feature-box-image">
											{$Image.FocusFill(576, 576)}
										</div>
									<% end_if %>

									<% if $Title %>
										<h3 class="login__feature-box-title">
											{$Title}
										</h3>
									<% end_if %>

									<% if $Content %>
										<p class="login__feature-box-content">
											{$Content}
										</p>
									<% end_if %>
								</div>
							</li>
						<% end_loop %>
					</ul>
				<% end_if %>

				<% if $FeatureBoxesContent %>
					<p class="login__bottom-content">
						{$FeatureBoxesContent}
					</p>
				<% end_if %>
			<% end_with %>
		</div>
	</div>

	<% include App\Includes\Footer %>

</div>

{$SiteConfig.EndOfBody.RAW}
</body>
</html>
