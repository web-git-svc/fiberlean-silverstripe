<% include App\Email\Includes\Top %>

<font size="3" face="Helvetica,arial,sans-serif" color="#192638" style="font-weight: bold; font-size: 20px; color: #032f33;">
	<br>
	<h1 style="font-size: 20px; color:#032f33;">New Enquiry Form Submission</h1>
</font>

<font size="3" face="Helvetica,arial,sans-serif" style="font-size: 16px; line-height: 1.5; color: #032f33;">
	<p>You have received a submission through the enquiry form on the <a href="{$AbsoluteBaseURL}">{$SiteConfig.Title}</a> website.</p>

	<p>
		<% if $Name %>
			<strong>Name:</strong> {$Name}<br />
		<% end_if %>

		<% if $Company %>
			<strong>Company:</strong> {$Company}<br />
		<% end_if %>

		<% if $Telephone %>
			<strong>Telephone:</strong> {$Telephone}<br />
		<% end_if %>

		<% if $Email %>
			<strong>Email:</strong> <a href="{$Email}">{$Email}</a><br />
		<% end_if %>

		<% if $Message %>
			<strong>Message:</strong><br />
			{$Message}<br />
		<% end_if %>

<%--		<% if $SubscribeToEmailNewsletter %>--%>
<%--			<br/>--%>
<%--			<% if $Name %>{$Name} <% end_if %>would like to subscribe to the email newsletter.<br/>--%>
<%--		<% end_if %>--%>

		<% if $AreasOfInterest %>
			<br />
			<% if $Name %>{$Name} <% end_if %>is interested in the following areas: {$AreasOfInterest}.
		<% end_if %>
	</p>
</font>

<% include App\Email\Includes\Bottom %>
