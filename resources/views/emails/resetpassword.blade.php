<body>
    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
      <tbody>
          <tr>
              <td width="100%" align="center">
                  <p style="font-family:'Ubuntu', sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">
                      Hello {{ $messagedata->name }} the password for your account has been reset to this one {{ $messagedata->password }}.
                      Click  <a href="/"  target="_blank">here </a> login to your account.
                  </p>
              </td>
          </tr>
      </tbody>
    </table>
</body>