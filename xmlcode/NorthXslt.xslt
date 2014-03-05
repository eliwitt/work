<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxsl="urn:schemas-microsoft-com:xslt" exclude-result-prefixes="msxsl" >
    <xsl:template match="/Rag">
      <html>
        <body>
          <h1>North Articles</h1>
          <xsl:apply-templates select="Article"/>
		<p/>
		<input type="button" value="Back" onClick="history.back()"/>
        </body>
      </html>
    </xsl:template>
  <xsl:template match="Article">
    <p><table border="1">
          <tr>
            <td bgcolor="yellow">
              <xsl:value-of select="Magazine" />
            </td>
            <td bgcolor="lightblue">
              <xsl:value-of select="IssueDate" />
            </td>
          </tr>
          <tr>
            <td>
              <xsl:value-of select="Headline" />
            </td>
            <td>
              <xsl:value-of select="Byline" />
            </td>
          </tr>
          <tr>
            <xsl:apply-templates select="ArticleText"/>
          </tr>
          <tr>
            <xsl:apply-templates select="BIOGRAPHY"/>
          </tr>
    </table>
    </p>
  </xsl:template>
   <xsl:template match="ArticleText">
    <td colspan="3">
      <xsl:apply-templates/>
    </td>
  </xsl:template>
  <xsl:template match="Subhead">
    <p><b>
      <xsl:apply-templates />
    </b>
    </p>
  </xsl:template>
  <xsl:template match="BIOGRAPHY">
    <td bgcolor="yellow" colspan="2">
      <xsl:apply-templates/>
    </td>
  </xsl:template>
  <xsl:template match="Author">
    <font color="red">
      <xsl:apply-templates />
    </font>
  </xsl:template>
  <xsl:template match="Book">
    <b>
      <xsl:apply-templates />
    </b>
  </xsl:template>
</xsl:stylesheet>
