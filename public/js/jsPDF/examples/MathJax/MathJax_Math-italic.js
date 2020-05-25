﻿(function (jsPDFAPI) {
var font = "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FRsKDQgUCxUMDAwEBgUJBQUBy0ouOy4YO0EkKDIkI0gAAQAo//UBfgGvADIAADcGFRQXFjMyNzY3NjMyFxYHBgcGIyInLgE1NDc+ATc2OwEWFQYHBiMiBwYPATMWFRQHI4oKLxchDw0gJwoDCAQFAwYnKismJDM+LyFpPgIoJg8CEgIjJgRgIQSxDRS22SEpSB0QAwYaBw8PAwoREw4TWT9YPCw7BQEHDxIFAQELYAwJChMIAAIAAAAAArwAZAADAAcAADE1MxUhNTMVZAH0ZGRkZGQAAgAAAAABLABkAAMABwAAMTUzFTM1MxVkZGRkZGRkAAABAAAAAABkAGQAAwAAMTUzFWRkZAAAAAAAABYBDgABAAAAAAAAACwAWgABAAAAAAABAAwAoQABAAAAAAACAAYAvAABAAAAAAADACMBCwABAAAAAAAEABMBVwABAAAAAAAFAAsBgwABAAAAAAAGABMBtwABAAAAAAANAPcDuwABAAAAAAAOABoE6QABAAAAAAAQAAwFHgABAAAAAAARAAYFOQADAAEECQAAAFgAAAADAAEECQABABgAhwADAAEECQACAAwArgADAAEECQADAEYAwwADAAEECQAEACYBLwADAAEECQAFABYBawADAAEECQAGACYBjwADAAEECQANAe4BywADAAEECQAOADQEswADAAEECQAQABgFBAADAAEECQARAAwFKwBDAG8AcAB5AHIAaQBnAGgAdAAgACgAYwApACAAMgAwADAAOQAtADIAMAAxADAAIABEAGUAcwBpAGcAbgAgAFMAYwBpAGUAbgBjAGUALAAgAEkAbgBjAC4AAENvcHlyaWdodCAoYykgMjAwOS0yMDEwIERlc2lnbiBTY2llbmNlLCBJbmMuAABNAGEAdABoAEoAYQB4AF8ATQBhAHQAaAAATWF0aEpheF9NYXRoAABJAHQAYQBsAGkAYwAASXRhbGljAABGAG8AbgB0AEYAbwByAGcAZQAgADIALgAwACAAOgAgAE0AYQB0AGgASgBhAHgAXwBNAGEAdABoAC0ASQB0AGEAbABpAGMAAEZvbnRGb3JnZSAyLjAgOiBNYXRoSmF4X01hdGgtSXRhbGljAABNAGEAdABoAEoAYQB4AF8ATQBhAHQAaAAtAEkAdABhAGwAaQBjAABNYXRoSmF4X01hdGgtSXRhbGljAABWAGUAcgBzAGkAbwBuACAAMQAuADEAAFZlcnNpb24gMS4xAABNAGEAdABoAEoAYQB4AF8ATQBhAHQAaAAtAEkAdABhAGwAaQBjAABNYXRoSmF4X01hdGgtSXRhbGljAABDAG8AcAB5AHIAaQBnAGgAdAAgACgAYwApACAAMgAwADAAOQAtADIAMAAxADAALAAgAEQAZQBzAGkAZwBuACAAUwBjAGkAZQBuAGMAZQAsACAASQBuAGMALgAgACgAPAB3AHcAdwAuAG0AYQB0AGgAagBhAHgALgBvAHIAZwA+ACkALAAKAHcAaQB0AGgAIABSAGUAcwBlAHIAdgBlAGQAIABGAG8AbgB0ACAATgBhAG0AZQAgAE0AYQB0AGgASgBhAHgAXwBNAGEAdABoAC4ACgAKAFQAaABpAHMAIABGAG8AbgB0ACAAUwBvAGYAdAB3AGEAcgBlACAAaQBzACAAbABpAGMAZQBuAHMAZQBkACAAdQBuAGQAZQByACAAdABoAGUAIABTAEkATAAgAE8AcABlAG4AIABGAG8AbgB0ACAATABpAGMAZQBuAHMAZQAsACAAVgBlAHIAcwBpAG8AbgAgADEALgAxAC4ACgBUAGgAaQBzACAAbABpAGMAZQBuAHMAZQAgAGEAdgBhAGkAbABhAGIAbABlACAAdwBpAHQAaAAgAGEAIABGAEEAUQAgAGEAdAA6AAoAaAB0AHQAcAA6AC8ALwBzAGMAcgBpAHAAdABzAC4AcwBpAGwALgBvAHIAZwAvAE8ARgBMAABDb3B5cmlnaHQgKGMpIDIwMDktMjAxMCwgRGVzaWduIFNjaWVuY2UsIEluYy4gKDx3d3cubWF0aGpheC5vcmc+KSwKd2l0aCBSZXNlcnZlZCBGb250IE5hbWUgTWF0aEpheF9NYXRoLgoKVGhpcyBGb250IFNvZnR3YXJlIGlzIGxpY2Vuc2VkIHVuZGVyIHRoZSBTSUwgT3BlbiBGb250IExpY2Vuc2UsIFZlcnNpb24gMS4xLgpUaGlzIGxpY2Vuc2UgYXZhaWxhYmxlIHdpdGggYSBGQVEgYXQ6Cmh0dHA6Ly9zY3JpcHRzLnNpbC5vcmcvT0ZMAABoAHQAdABwADoALwAvAHMAYwByAGkAcAB0AHMALgBzAGkAbAAuAG8AcgBnAC8ATwBGAEwAAGh0dHA6Ly9zY3JpcHRzLnNpbC5vcmcvT0ZMAABNAGEAdABoAEoAYQB4AF8ATQBhAHQAaAAATWF0aEpheF9NYXRoAABJAHQAYQBsAGkAYwAASXRhbGljAAAAAAIAAAAAAAD/gwAyAAAAAAAAAAAAAAAAAAAAAAAAAAAAZgAAAAEAAgADABIAJAAlACYAJwAoACkAKgArACwALQAuAC8AMAAxADIAMwA0ADUANgA3ADgAOQA6ADsAPAA9AEQARQBGAEcASABJAEoASwBMAE0ATgBPAFAAUQBSAFMAVABVAFYAVwBYAFkAWgBbAFwAXQECAQMAqAEEAQUBBgEHAQgBCQEKAQsAnwEMAQ0BDgEPARABEQESARMBFAEVARYAlwEXARgBGQCbARoBGwEcAR0BHgEfASABIQEiASMBJAElASYBJwEoASkBKgd1bmkwMEEwBUdhbW1hBVRoZXRhBkxhbWJkYQJYaQJQaQVTaWdtYQdVcHNpbG9uA1BoaQNQc2kFYWxwaGEEYmV0YQVnYW1tYQVkZWx0YQdlcHNpbG9uBHpldGEDZXRhBXRoZXRhBGlvdGEFa2FwcGEGbGFtYmRhAm51AnhpB29taWNyb24DcmhvBnNpZ21hMQVzaWdtYQN0YXUHdXBzaWxvbgNwaGkDY2hpA3BzaQVvbWVnYQZ0aGV0YTEEcGhpMQZvbWVnYTEHdW5pMDNGMQd1bmkwM0Y1B3VuaUVGRkQHdW5pRUZGRQd1bmlFRkZGAAAAAAAAAf//AAIAAQAAAA4AAAAYAAAAAAACAAEAAwBlAAEABAAAAAIAAAAAAAEAAAAAyYlvMQAAAADG+TJPAAAAAMn0Jds=";
var callAddFont = function () {
this.addFileToVFS("MathJax_Math-italic-normal.ttf", font);
this.addFont("MathJax_Math-italic-normal.ttf", "mathjax_math-italic", "normal");
};
jsPDFAPI.events.push(['addFonts', callAddFont])
 })(jsPDF.API);