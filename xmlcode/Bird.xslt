<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxsl="urn:schemas-microsoft-com:xslt" exclude-result-prefixes="msxsl"
>
  <xsl:template match="DOCUMENT">
    <html>
      <body>
        <h1>Bird Watching</h1>
        <p>
          <table border="1">
        <xsl:apply-templates select="SIGHTING"/>
          </table>
        </p>
	<input type="button" value="Back" onClick="history.back()"/>
      </body>
    </html>
  </xsl:template>
  <xsl:template match="SIGHTING">
        <tr>
          <td bgcolor="yellow">
            <xsl:value-of select="BIRD" />
          </td>
          <td bgcolor="lightblue">
            <xsl:value-of select="DATE" />
          </td>
        </tr>
  </xsl:template>
</xsl:stylesheet>
