<div class="bg--blue-dark">
	<div class="element-enquiry-form">
		<div class="container">
			<div class="typography">
				<div class="center typography--white trim">
					{$SiteConfig.EnquiryFormContent}
				</div>
			</div>

			<div id="enquiry-form" class="element-enquiry-form__form">
				<% if $PageController.Sent('EnquiryForm') %>
					{$SiteConfig.EnquiryFormSuccessContent}
				<% else %>
					{$PageController.EnquiryForm}
				<% end_if %>
			</div>
		</div>
	</div>
</div>
