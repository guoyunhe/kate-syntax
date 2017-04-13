<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE language SYSTEM "language.dtd"
[
<?php require('css-entities.php'); ?>
]>
<!--

Changelog:

Version 2, by Guo Yunhe <guoyunhebrave@gmail.com>, 2017-04-13
- Rename LESSCSS -> LESS
- Improved syntax for nested rules, properties and functions
- Better highlight colors

Version 1, by Wilbert Berendsen <wilbert@kde.nl>

-->
<language name="LESS" version="2" kateversion="5.0" section="Markup" extensions="*.less" mimetype="text/css" author="from CCS:Wilbert Berendsen (wilbert@kde.nl)" license="LGPL">

    <highlighting>

        <list name="properties">
            <?php require('css-properties.php'); ?>
        </list>

        <list name="values">
            <?php require('css-values.php'); ?>
        </list>

        <list name="functions">
            <?php require('css-functions.php'); ?>
            <!-- LESS functions http://lesscss.org/functions/ -->
            <item>color</item>
            <item>image-size</item>
            <item>image-width</item>
            <item>image-height</item>
            <item>convert</item>
            <item>data-uri</item>
            <item>default</item>
            <item>unit</item>
            <item>get-unit</item>
            <item>svg-gradient</item>
            <item>escape</item>
            <item>e</item>
            <item>%</item>
            <item>replace</item>
            <item>length</item>
            <item>extract</item>
            <item>ceil</item>
            <item>floor</item>
            <item>percentage</item>
            <item>round</item>
            <item>sqrt</item>
            <item>abs</item>
            <item>sin</item>
            <item>asin</item>
            <item>cos</item>
            <item>acos</item>
            <item>tan</item>
            <item>atan</item>
            <item>pi</item>
            <item>pow</item>
            <item>mod</item>
            <item>min</item>
            <item>max</item>
            <item>isnumber</item>
            <item>isstring</item>
            <item>iscolor</item>
            <item>iskeyword</item>
            <item>isurl</item>
            <item>ispixel</item>
            <item>isem</item>
            <item>ispercentage</item>
            <item>isunit</item>
            <item>isruleset</item>
            <item>rgb</item>
            <item>rgba</item>
            <item>argb</item>
            <item>hsl</item>
            <item>hsla</item>
            <item>hsv</item>
            <item>hsva</item>
            <item>hue</item>
            <item>saturation</item>
            <item>lightness</item>
            <item>hsvhue</item>
            <item>hsvsaturation</item>
            <item>hsvvalue</item>
            <item>red</item>
            <item>green</item>
            <item>blue</item>
            <item>alpha</item>
            <item>luma</item>
            <item>luminance</item>
            <item>saturate</item>
            <item>desaturate</item>
            <item>lighten</item>
            <item>darken</item>
            <item>fadein</item>
            <item>fadeout</item>
            <item>fade</item>
            <item>spin</item>
            <item>mix</item>
            <item>tint</item>
            <item>shade</item>
            <item>greyscale</item>
            <item>contrast</item>
            <item>multiply</item>
            <item>screen</item>
            <item>overlay</item>
            <item>softlight</item>
            <item>hardlight</item>
            <item>difference</item>
            <item>exclusion</item>
            <item>average</item>
            <item>negation</item>
        </list>

        <list name="mediatypes">
            <item> all </item>
            <item> aural </item>
            <item> braille </item>
            <item> embossed </item>
            <item> handheld </item>
            <item> print </item>
            <item> projection </item>
            <item> screen </item>
            <item> speech </item>
            <item> tty </item>
            <item> tv </item>
        </list>

        <list name="mediatypes_op">
            <item> not </item>
            <item> only </item>
        </list>

        <list name="media_features">
            <item> width </item>
            <item> min-width </item>
            <item> max-width</item>
            <item> height </item>
            <item> min-height </item>
            <item> max-height </item>
            <item> device-width </item>
            <item> min-device-width </item>
            <item> max-device-width </item>
            <item> device-height </item>
            <item> min-device-height </item>
            <item> max-device-height </item>
            <item> orientation </item>
            <item> aspect-ratio </item>
            <item> min-aspect-ratio </item>
            <item> max-aspect-ratio </item>
            <item> device-aspect-ratio </item>
            <item> min-device-aspect-ratio </item>
            <item> max-device-aspect-ratio </item>
            <item> color </item>
            <item> min-color </item>
            <item> max-color </item>
            <item> color-index </item>
            <item> min-color-index </item>
            <item> max-color-index </item>
            <item> monochrome </item>
            <item> min-monochrome </item>
            <item> max-monochrome </item>
            <item> resolution </item>
            <item> min-resolution </item>
            <item> max-resolution </item>
            <item> scan </item>
            <item> grid </item>
        </list>

        <list name="pseudoclasses">
            <?php require('css-pseudoclasses.php'); ?>
            <item> extend </item>
        </list>

        <contexts>
            <context name="Base" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindComments" />
                <DetectChar attribute="Normal Text" context="RuleSet" char="{" beginRegion="ruleset" />
                <RegExpr attribute="Variable" context="VariableDefine" String="@+&namestart;&namechar;*\s*:" lookAhead="true" />
                <RegExpr attribute="At Rule" context="AtRule" String="@&atrules;\b" />
                <IncludeRules context="FindSelectors" />
            </context>

            <!-- find selectors // .class #id :hover :nth-child(2n+1) [type="search"] -->
            <context name="FindSelectors" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindInterpolations" />
                <IncludeRules context="FindVariables" />
                <DetectChar attribute="Selector Attribute" context="SelectorAttr" char="[" />
                <RegExpr attribute="Selector Id" context="#stay" String="#&namestart;&namechar;*" />
                <RegExpr attribute="Selector Class" context="#stay" String="\.&namestart;&namechar;*" />
                <RegExpr attribute="Selector Pseudo" context="#stay" String=":lang\([\w_-]+\)" />
                <DetectChar attribute="Selector Pseudo" context="SelectorPseudo" char=":" />
            </context>

            <!-- find variables // $page-width -->
            <context name="FindVariables" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Variable" context="#stay" String="@[a-zA-Z0-9\-_@]+"  />
            </context>

            <!-- find interpolations // @{class} -->
            <context name="FindInterpolations" attribute="Normal Text" lineEndContext="#stay">
                <Detect2Chars attribute="Variable" context="Interpolation" char="@" char1="{" /> <!-- @{variable} -->
                <Detect2Chars attribute="Variable" context="Interpolation" char="@" char1="@" /> <!-- @@variable -->
            </context>

            <!-- find functions // rgba(255,255,255,0.75) -->
            <context name="FindFunctions" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Function" context="Function" String="[a-z\-]+\(" lookAhead="true" />
            </context>

            <!-- find values //  10px 12pt 2.5em 1rem 75% #ffcc99 red solid -->
            <context name="FindValues" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Annotation" context="#stay" String="!important\b" />
                <RegExpr attribute="Annotation" context="#stay" String="!default\b" />
                <IncludeRules context="FindVariables" />
                <keyword attribute="Value" context="#stay" String="values" />
                <keyword attribute="Value" context="#stay" String="colors" />
                <RegExpr attribute="Value" context="#stay" String="#([0-9A-Fa-f]{3}){1,4}\b" />
                <RegExpr attribute="Value" context="#stay" String="[-+]?[0-9.]+(em|ex|ch|rem|vw|vh|vm|px|in|cm|mm|pt|pc|deg|rad|grad|turn|ms|s|Hz|kHz)\b" />
                <RegExpr attribute="Value" context="#stay" String="[-+]?[0-9.]+[%]?" />
                <RegExpr attribute="Normal Text" context="#stay" String="[\w\-]+" />
            </context>

            <!-- find strings // "some words" 'some words' -->
            <context name="FindStrings" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="String" context="StringDQ" char="&quot;" />
                <DetectChar attribute="String" context="StringSQ" char="'" />
            </context>

            <!-- find comments // /* comment */  // comment -->
            <context name="FindComments" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Region Marker" context="#stay" String="/\*BEGIN.*\*/" beginRegion="UserDefined" />
                <RegExpr attribute="Region Marker" context="#stay" String="//\s*BEGIN.*" beginRegion="UserDefined" />
                <RegExpr attribute="Region Marker" context="#stay" String="/\*END.*\*/" endRegion="UserDefined" />
                <RegExpr attribute="Region Marker" context="#stay" String="//\s*END.*" endRegion="UserDefined" />
                <Detect2Chars attribute="Comment" context="Comment" char="/" char1="*" beginRegion="comment" />
                <Detect2Chars attribute="Comment" context="LessComment" char="/" char1="/" />
            </context>

            <context name="AtRule" attribute="Normal Text" lineEndContext="#pop">
                <IncludeRules context="FindComments" />
                <IncludeRules context="FindStrings" />
                <keyword attribute="Value" context="#stay" String="mediatypes" />
                <keyword attribute="Property" context="#stay" String="media_features" />
                <AnyChar attribute="Normal Text" context="#pop" String=";{" lookAhead="true" />
                <IncludeRules context="FindVariables" />
                <IncludeRules context="FindValues" />
            </context>

            <context name="VariableDefine" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindVariables" />
                <DetectChar attribute="Normal Text" context="RuleParameters" char=":" />
            </context>

            <!-- Interpolation -->
            <context name="Interpolation" attribute="Variable" lineEndContext="#stay">
                <DetectIdentifier/>
                <DetectChar attribute="Variable" context="#pop" char="}" />
            </context>

            <context name="SelectorAttr" attribute="Selector Attribute" lineEndContext="#stay">
                <DetectChar attribute="Selector Attribute" context="#pop" char="]" />
                <IncludeRules context="FindStrings" />
            </context>

            <context name="SelectorPseudo" attribute="Selector Pseudo" lineEndContext="#pop"
                     fallthrough="true" fallthroughContext="#pop">
                <keyword attribute="Selector Pseudo" context="#pop" String="pseudoclasses" />
            </context>

            <context name="LessComment" attribute="Comment" lineEndContext="#pop">
                <IncludeRules context="##Alerts" />
            </context>

            <context name="Comment" attribute="Comment" lineEndContext="#stay">
                <Detect2Chars attribute="Comment" context="#pop" char="*" char1="/" endRegion="comment" />
                <IncludeRules context="##Alerts" />
            </context>

            <context name="RuleSet" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="Normal Text" context="RuleSet" char="{" beginRegion="ruleset" />
                <DetectChar attribute="Normal Text" context="#pop" char="}" endRegion="ruleset" />
                <RegExpr attribute="Property" context="Rule" String="&namestart;&namechar;*\s*:" lookAhead="true" />
                <IncludeRules context="Base" />
            </context>

            <context name="Rule" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="Normal Text" context="RuleParameters" char=":" />
                <keyword attribute="Property" context="#stay" String="properties" />
                <RegExpr attribute="Unknown Property" context="#stay" String="-?[A-Za-z_-]+(?=\s*:)" />
                <RegExpr attribute="Error" context="#stay" String="\S" />
            </context>

            <context name="RuleParameters" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindComments" />
                <IncludeRules context="FindStrings" />
                <IncludeRules context="FindFunctions" />
                <IncludeRules context="FindValues" />
                <!-- Jump out conditions -->
                <DetectChar attribute="Normal Text" context="#pop#pop" char=";" />
                <DetectChar attribute="Normal Text" context="#pop#pop#pop" char="}" endRegion="ruleset" />
            </context>

            <context name="Function" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="Normal Text" context="FunctionParameters" char="(" />
                <keyword attribute="Function" context="#stay" String="functions" />
            </context>

            <context name="FunctionParameters" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindComments" />
                <IncludeRules context="FindStrings" />
                <IncludeRules context="FindVariables" />
                <IncludeRules context="FindFunctions" />
                <IncludeRules context="FindValues" />
                <!-- Jump out conditions -->
                <DetectChar attribute="Normal Text" context="#pop#pop" char=")" />
            </context>

            <!-- string contexts -->
            <context attribute="String" lineEndContext="#stay" name="StringDQ">
                <DetectChar attribute="String" context="#pop" char="&quot;" />
                <IncludeRules context="InsideString" />
            </context>

            <context attribute="String" lineEndContext="#stay" name="StringSQ">
                <DetectChar attribute="String" context="#pop" char="'" />
                <IncludeRules context="InsideString" />
            </context>

            <context attribute="String" lineEndContext="#stay" name="InsideString">
                <RegExpr attribute="String" context="#stay" String="\\[&quot;']" />
                <DetectIdentifier/>
                <IncludeRules context="FindInterpolations" />
            </context>

        </contexts>

        <itemDatas>
            <?php require('css-styles.php'); ?>
        </itemDatas>
    </highlighting>

    <general>
        <keywords casesensitive="0" weakDeliminator="-%"/>
        <comments>
            <comment name="multiLine" start="/*" end="*/" />
            <comment name="singleLine" start="//"/>
        </comments>
    </general>
</language>
