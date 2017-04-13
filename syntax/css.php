<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE language SYSTEM "language.dtd"
[
  <!-- http://www.w3.org/TR/CSS21/syndata.html#tokenization -->
  <!ENTITY nmstart "[_a-zA-Z]|(\\[0-9a-fA-F]{1,6})|(\\[^\n\r\f0-9a-fA-F])">
  <!ENTITY nmchar  "[_a-zA-Z0-9-]|(\\[0-9a-fA-F]{1,6})|(\\[^\n\r\f0-9a-fA-F])">
]>

<!--

Kate CSS syntax highlighting definition

Changelog:

- Version 4, by Guo Yunhe guoyunhebrave@gmail.com
- Remake for complex CSS syntax, avoid errors

- Version 2.13, by Guo Yunhe
- Add all W3C Work Draft properties

- Version 2.06, by Mte90:
- CSS3 tag

- Version 2.03, by Milian Wolff:
- Make it spelling aware

- Version 2.08, Joseph Wenninger:
- CSS3 media queries

-->

<language name="CSS" version="5" kateversion="5.0" section="Markup" extensions="*.css" indenter="cstyle" mimetype="text/css" author="Wilbert Berendsen (wilbert@kde.nl)" license="LGPL" priority="10">

    <highlighting>
        <list name="properties">
            <?php require('css-properties.php'); ?>
        </list>

        <list name="values">
            <?php require('css-values.php'); ?>
        </list>

        <list name="functions">
            <item> url </item>
            <item> attr </item>
            <item> rect </item>
            <item> rgb </item>
            <item> rgba </item>
            <item> hsl </item>
            <item> hsla </item>
            <item> counter </item>
            <item> counters </item>

            <!-- in @font-face -->
            <item> local </item>
            <item> format </item>

            <!-- Trident (a.k.a., MSHTML) rendering engine functional notation extensions -->
            <item> expression </item>

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
            <item> hover </item>
            <item> link </item>
            <item> visited </item>
            <item> active </item>
            <item> focus </item>
            <item> first-child </item>
            <item> last-child </item>
            <item> only-child </item>
            <item> first-of-type </item>
            <item> last-of-type </item>
            <item> only-of-type </item>
            <item> first-letter </item>
            <item> first-line </item>
            <item> before </item>
            <item> after </item>
            <item> selection </item>
            <item> root </item>
            <item> empty </item>
            <item> target </item>
            <item> enabled </item>
            <item> disabled </item>
            <item> checked </item>
            <item> indeterminate </item>
            <item> nth-child </item>
            <item> nth-last-child </item>
            <item> nth-of-type </item>
            <item> nth-last-of-type </item>
            <item> not </item>
        </list>

        <contexts>
            <context name="Base" attribute="Normal Text" lineEndContext="#stay">
                <IncludeRules context="FindComments" />
                <DetectChar attribute="Normal Text" context="RuleSet" char="{" beginRegion="ruleset" />
                <RegExpr attribute="At Rule" context="AtRule" String="@[a-zA-Z0-1-]+\b" />
                <IncludeRules context="FindSelectors" />
            </context>

            <!-- find selectors // .class #id :hover :nth-child(2n+1) [type="search"] -->
            <context name="FindSelectors" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="Selector Attribute" context="SelectorAttr" char="[" />
                <RegExpr attribute="Selector Id" context="#stay" String="#(-)?(&nmstart;)(&nmchar;)*" />
                <RegExpr attribute="Selector Class" context="#stay" String="\.([a-zA-Z0-9\-_]|[\x80-\xFF]|\\[0-9A-Fa-f]{1,6})*" />
                <RegExpr attribute="Selector Pseudo" context="#stay" String=":lang\([\w_-]+\)" />
                <DetectChar attribute="Selector Pseudo" context="SelectorPseudo" char=":" />
            </context>

            <!-- find functions // rgba(255,255,255,0.75) -->
            <context name="FindFunctions" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Function" context="Function" String="[a-z\-]+\(" lookAhead="true" />
            </context>

            <!-- find values //  10px 12pt 2.5em 1rem 75% #ffcc99 red solid -->
            <context name="FindValues" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Annotation" context="#stay" String="!important\b" />
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

            <!-- find comments // /* comment */ -->
            <context name="FindComments" attribute="Normal Text" lineEndContext="#stay">
                <RegExpr attribute="Region Marker" context="#stay" String="/\*BEGIN.*\*/" beginRegion="UserDefined" />
                <RegExpr attribute="Region Marker" context="#stay" String="/\*END.*\*/" endRegion="UserDefined" />
                <Detect2Chars attribute="Comment" context="Comment" char="/" char1="*" beginRegion="comment" />
            </context>

            <context name="AtRule" attribute="Normal Text" lineEndContext="#pop">
                <IncludeRules context="FindComments" />
                <IncludeRules context="FindStrings" />
                <keyword attribute="Value" context="#stay" String="mediatypes" />
                <keyword attribute="Property" context="#stay" String="media_features" />
                <AnyChar attribute="Normal Text" context="#pop" String=";{" lookAhead="true" />
                <IncludeRules context="FindValues" />
            </context>

            <context name="SelectorAttr" attribute="Selector Attribute" lineEndContext="#stay">
                <DetectChar attribute="Selector Attribute" context="#pop" char="]" />
                <IncludeRules context="FindStrings" />
            </context>

            <context name="SelectorPseudo" attribute="Selector Pseudo" lineEndContext="#pop"
                     fallthrough="true" fallthroughContext="#pop">
                <keyword attribute="Selector Pseudo" context="#pop" String="pseudoclasses" />
            </context>

            <context name="Comment" attribute="Comment" lineEndContext="#stay">
                <Detect2Chars attribute="Comment" context="#pop" char="*" char1="/" endRegion="comment" />
                <IncludeRules context="##Alerts" />
            </context>

            <context name="RuleSet" attribute="Normal Text" lineEndContext="#stay">
                <DetectChar attribute="Normal Text" context="RuleSet" char="{" beginRegion="ruleset" />
                <DetectChar attribute="Normal Text" context="#pop" char="}" endRegion="ruleset" />
                <RegExpr attribute="Property" context="Rule" String="-?[A-Za-z_-]+(?=\s*:)" lookAhead="true" />
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
                <IncludeRules context="FindValues" />
                <!-- Jump out conditions -->
                <DetectChar attribute="Normal Text" context="#pop#pop" char=")" />
            </context>

            <!-- string contexts -->
            <context name="StringDQ" attribute="String" lineEndContext="#stay">
                <DetectChar attribute="String" context="#pop" char="&quot;" />
                <IncludeRules context="InsideString" />
            </context>

            <context name="StringSQ" attribute="String" lineEndContext="#stay">
                <DetectChar attribute="String" context="#pop" char="'" />
                <IncludeRules context="InsideString" />
            </context>

            <context name="InsideString" attribute="String" lineEndContext="#stay">
                <RegExpr attribute="String" context="#stay" String="\\[&quot;']" />
                <DetectIdentifier/>
            </context>

        </contexts>

        <itemDatas>
            <itemData name="Normal Text" defStyleNum="dsNormal" spellChecking="false"/>
            <itemData name="At Rule" defStyleNum="dsImport" spellChecking="false"/>
            <itemData name="Property" defStyleNum="dsKeyword" spellChecking="false"/>
            <itemData name="Unknown Property" defStyleNum="dsNormal" spellChecking="false"/>
            <itemData name="String" defStyleNum="dsString"/>
            <itemData name="Value" defStyleNum="dsDecVal" spellChecking="false"/>
            <itemData name="Function" defStyleNum="dsFunction" spellChecking="false"/>
            <itemData name="Annotation" defStyleNum="dsAttribute" spellChecking="false"/>
            <itemData name="Selector Id" defStyleNum="dsPreprocessor" bold="1" spellChecking="false"/>
            <itemData name="Selector Class" defStyleNum="dsFunction" spellChecking="false"/>
            <itemData name="Selector Attribute" defStyleNum="dsExtension" spellChecking="false"/>
            <itemData name="Selector Pseudo" defStyleNum="dsInformation" italic="1" spellChecking="false"/>
            <itemData name="Comment" defStyleNum="dsComment" />
            <itemData name="Region Marker" defStyleNum="dsRegionMarker" spellChecking="false"/>
            <itemData name="Alert" defStyleNum="dsAlert" spellChecking="false"/>
            <itemData name="Error" defStyleNum="dsError" spellChecking="false"/>
        </itemDatas>
    </highlighting>

    <general>
        <keywords casesensitive="0" weakDeliminator="-%"/>
        <comments>
            <comment name="multiLine" start="/*" end="*/" />
        </comments>
    </general>

</language>
