<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">

	<xsl:template match="ecorpse">
		<html>
			<head>
			</head>
			<body>
				<xsl:apply-templates/>
			</body>
		</html>
	</xsl:template>

	<xsl:template match="language">
	</xsl:template>

	<xsl:template match="stories">
		<xsl:apply-templates/>
	</xsl:template>

	<xsl:template match="points">
		<xsl:apply-templates/>
	</xsl:template>

	<xsl:template match="story">
		<h2>
			<xsl:text>Story: </xsl:text>
			<xsl:value-of select="./@id"/>
		</h2>
		<xsl:apply-templates/>
		<xsl:call-template name="input">
			<xsl:with-param name="storyID" select="./@id"/>
		</xsl:call-template>
	</xsl:template>

	<xsl:template match="content">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>

	<xsl:template match="writtenBy">
		<xsl:apply-templates/>
	</xsl:template>

	<xsl:template match="date">
		<xsl:apply-templates/>
	</xsl:template>

	<xsl:template name="input">
		<xsl:param name="storyID"/>
		<p><xsl:value-of select="$storyID"/></p>
		<form action="submit.php" method="post">
			<p>
				<xsl:text>Användarnamn: </xsl:text>
				<input type="text" name="username"/>
				<xsl:text>Ny post: </xsl:text>
				<input type="text" name="newPost"/>
				<input type="hidden" name="storyID" value="{$storyID}"/>
				<input type="submit" value="Submit"/>
			</p>
		</form>
	</xsl:template>

</xsl:stylesheet>