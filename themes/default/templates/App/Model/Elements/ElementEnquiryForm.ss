<div class="bg--blue-dark">
	<div class="element-enquiry-form">
		<% include App\Model\Elements\Includes\Breadcrumbs %>

		<div class="container">
			<div id="enquiry-form" class="element-enquiry-form__form">
				<div class="typography">
					<div class="center typography--white trim">
						<% if $PageController.Sent('EnquiryForm') %>
							{$SiteConfig.EnquiryFormSuccessContent}

							<script>
								dataLayer.push({
									'event': 'FormSubmitted',
									'FormTitle': 'Enquiry Form'
								});
							</script>
						<% else %>
							{$TitleTag('typography--large')}
							{$SiteConfig.EnquiryFormContent}
						<% end_if %>
					</div>
				</div>

				<% if not $PageController.Sent('EnquiryForm') %>
					{$PageController.EnquiryForm}
				<% end_if %>
			</div>
		</div>
	</div>
</div>
