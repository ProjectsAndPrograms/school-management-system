/*!
* Date Picker
* version: 1.0.2
*  author: Cevad Tokatli <cevadtokatli@hotmail.com>
* website: http://cevadtokatli.com
*  github: https://github.com/cevadtokatli/date-picker
* license: MIT
*/
'use strict';

function _iterableToArrayLimit(r, l) {
  var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"];
  if (null != t) {
    var e,
      n,
      i,
      u,
      a = [],
      f = !0,
      o = !1;
    try {
      if (i = (t = t.call(r)).next, 0 === l) {
        if (Object(t) !== t) return;
        f = !1;
      } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0);
    } catch (r) {
      o = !0, n = r;
    } finally {
      try {
        if (!f && null != t.return && (u = t.return(), Object(u) !== u)) return;
      } finally {
        if (o) throw n;
      }
    }
    return a;
  }
}
function ownKeys(e, r) {
  var t = Object.keys(e);
  if (Object.getOwnPropertySymbols) {
    var o = Object.getOwnPropertySymbols(e);
    r && (o = o.filter(function (r) {
      return Object.getOwnPropertyDescriptor(e, r).enumerable;
    })), t.push.apply(t, o);
  }
  return t;
}
function _objectSpread2(e) {
  for (var r = 1; r < arguments.length; r++) {
    var t = null != arguments[r] ? arguments[r] : {};
    r % 2 ? ownKeys(Object(t), !0).forEach(function (r) {
      _defineProperty(e, r, t[r]);
    }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) {
      Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r));
    });
  }
  return e;
}
function _toPrimitive(t, r) {
  if ("object" != typeof t || !t) return t;
  var e = t[Symbol.toPrimitive];
  if (void 0 !== e) {
    var i = e.call(t, r || "default");
    if ("object" != typeof i) return i;
    throw new TypeError("@@toPrimitive must return a primitive value.");
  }
  return ("string" === r ? String : Number)(t);
}
function _toPropertyKey(t) {
  var i = _toPrimitive(t, "string");
  return "symbol" == typeof i ? i : String(i);
}
function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}
function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor);
  }
}
function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  Object.defineProperty(Constructor, "prototype", {
    writable: false
  });
  return Constructor;
}
function _defineProperty(obj, key, value) {
  key = _toPropertyKey(key);
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }
  return obj;
}
function _slicedToArray(arr, i) {
  return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest();
}
function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}
function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return _arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}
function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;
  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];
  return arr2;
}
function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

var Util = /*#__PURE__*/function () {
  function Util() {
    _classCallCheck(this, Util);
  }
  _createClass(Util, null, [{
    key: "getElement",
    value:
    /**
     * Returns the given element.
     * 
     * @param {String|HTMLElement} el 
     * @returns {HTMLElement}
     */
    function getElement(el) {
      if (typeof el === 'string') {
        return document.querySelector(el);
      }
      return el;
    }

    /**
     * Creates a event and initalizes it.
     * 
     * @param {String} name
     * @returns {Event} 
     */
  }, {
    key: "createEvent",
    value: function createEvent(name) {
      var event = document.createEvent('HTMLEvents') || document.createEvent('event');
      event.initEvent(name, false, true);
      return event;
    }

    /**
     * Attaches the events to the element.
     * 
     * @param {HTMLElement} el
     * @param {String[]} events
     * @param {EventListener} callback
     */
  }, {
    key: "addEventListener",
    value: function addEventListener(el, events, callback) {
      for (var i in events) {
        el.addEventListener(events[i], callback, true);
      }
    }

    /**
     * Removes the events from the element.
     * 
     * @param {HTMLElement} el
     * @param {String[]} events
     * @param {EventListener} callback
     */
  }, {
    key: "removeEventListener",
    value: function removeEventListener(el, events, callback) {
      for (var i in events) {
        el.removeEventListener(events[i], callback, true);
      }
    }

    /**
     * Attaches the events to the element for once.
     * 
     * @param {HTMLElement} el
     * @param {String[]} events
     * @param {Function} callback
     */
  }, {
    key: "addEventListenerOnce",
    value: function addEventListenerOnce(el, events, callback) {
      var _this = this;
      var cb = function cb(e) {
        _this.removeEventListener(el, events, cb);
        callback(e);
      };
      this.addEventListener(el, events, cb);
    }

    /**
     * Adds the given css class to the given element.
     * 
     * @param {HTMLElement} el 
     * @param {String} cname 
     */
  }, {
    key: "addClass",
    value: function addClass(el, cname) {
      if (el.classList) {
        el.classList.add(cname);
      } else {
        el.setAttribute('class', "".concat(el.getAttribute('class'), " ").concat(cname));
      }
    }

    /**
     * Removes the given css class from the given element.
     * 
     * @param {HTMLElement} el 
     * @param {String} cname 
     */
  }, {
    key: "removeClass",
    value: function removeClass(el, cname) {
      if (el.classList) {
        el.classList.remove(cname);
      } else {
        el.setAttribute('class', el.getAttribute('class').replace(cname, ' '));
      }
    }

    /**
     * Checks an element if it contains another element.
     * 
     * @param {HTMLElement} p
     * @param {HTMLElement} c
     * @returns Boolean
     */
  }, {
    key: "contains",
    value: function contains(p, c) {
      if (p.contains) {
        return p.contains(c);
      } else {
        while (c = c.parentNode) {
          if (c === p) {
            return true;
          }
        }
        return false;
      }
    }

    /**
     * Checks the browser if it is mobile.
     * 
     * @returns {Boolean}
     */
  }, {
    key: "isMobile",
    value: function isMobile() {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    /**
     *  Renders a number with given digits as string.
     * 
     * @param {Number} n
     * @param {Number} d
     * @param {String} p
     * @returns {String}
     */
  }, {
    key: "renderNumber",
    value: function renderNumber(n) {
      var d = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2;
      var p = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '0';
      var s = n.toString();
      while (s.length < d) {
        s = p + s;
      }
      return s;
    }

    /**
     * Gets day count of a year.
     * 
     * @param {Number} m
     * @param {Number} y
     * @returns {Number}
     */
  }, {
    key: "getDayCount",
    value: function getDayCount(m, y) {
      switch (m) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
          return 31;
        case 4:
        case 6:
        case 9:
        case 11:
          return 30;
        case 2:
          if (this.isLeapYear(y)) {
            return 29;
          }
          return 28;
      }
    }

    /**
     * Checks the given year whether it is a leap year or not.
     * 
     * @param {Number} y
     * @returns {Boolean} 
     */
  }, {
    key: "isLeapYear",
    value: function isLeapYear(y) {
      if (y % 4 == 0) {
        return true;
      }
      return false;
    }

    /**
     * Gets start and end year of the given year.
     * 
     * @param {Number} y
     * @returns {{start:Number, end:Number}} 
     */
  }, {
    key: "getStartEndYear",
    value: function getStartEndYear(y) {
      var s = y;
      while (s % 10 != 0) {
        s -= 1;
      }
      return {
        start: s,
        end: s + 10
      };
    }
  }]);
  return Util;
}();
Util.MOUSE_DOWN = Util.isMobile() ? 'touchstart' : 'mousedown';
Util.MOUSE_MOVE = Util.isMobile() ? 'touchmove' : 'mousemove';
Util.MOUSE_UP = Util.isMobile() ? 'touchend' : 'mouseup';
Util.ANIMATION_END = ['webkitAnimationEnd', 'mozAnimationEnd', 'oAnimationEnd', 'MSAnimationEnd', 'animationend'];
Util.TRANSITION_END = ['webkitTransitionEnd', 'oTransitionEnd', 'otransitionend', 'MSTransitionEnd', 'transitionend'];
Util.WHEEL_EVENTS = ['wheel', 'mousewheel', 'DOMMouseScroll'];

var DATE = 'DATE';
var HOUR = 'HOUR';
var DATEHOUR = 'DATEHOUR';
var DMY = 'DD/MM/YYYY';
var MDY = 'MM/DD/YYYY';
var $12 = '12';
var $24 = '24';
var MONTH = 'MONTH';
var YEAR = 'YEAR';
var YEAR_RANGE = 'YEAR_RANGE';
var TYPE = [DATE, HOUR, DATEHOUR];
var DATETYPE = [DMY, MDY];
var HOURTYPE = [$12, $24];

var DEFAULT_OPTIONS = {
  value: null,
  el: null,
  inputEl: null,
  toggleEl: null,
  type: DATE,
  dateType: DMY,
  hourType: $12,
  allowEmpty: true,
  showButtons: false,
  inputToggle: false,
  lang: 'en',
  orientation: false,
  showArrowButtons: false
};

var EN = {
  DAYS_ABBR: ['', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
  MONTHS: ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  MONTHS_ABBR: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  AM_PM: ['AM', 'PM'],
  BUTTONS: ['CANCEL', 'OK'],
  INVALID_DATE: 'Invalid Date'
};

var CHANGE = Util.createEvent('wdp.change');
var OPEN = Util.createEvent('wdp.open');
var CLOSE = Util.createEvent('wdp.close');
var SAVE = Util.createEvent('wdp.save');
var CANCEL = Util.createEvent('wdp.cancel');
var DESTROY = Util.createEvent('wdp.destroy');

var DatePicker = /*#__PURE__*/function () {
  /**
   * @constructor
   * @param {Object} opt
   */
  function DatePicker(opt) {
    var _this = this;
    _classCallCheck(this, DatePicker);
    var o = this.extractAttributes(opt);
    if (!(this.el = Util.getElement(o.el))) {
      throw new Error('Element could not be found');
    } else if (o.inputEl && (!(this.inputEl = Util.getElement(o.inputEl)) || this.inputEl.nodeName != 'INPUT')) {
      throw new Error('Input element could not be found');
    } else if (o.toggleEl && !(this.toggleEl = Util.getElement(o.toggleEl))) {
      throw new Error('Toggle element could not be found');
    }
    this.LANG = DatePicker.LANG[o.lang];
    if (Util.isMobile()) {
      this.el.classList.add('wdp-mobile');
    }
    this.parentEl = this.el.parentNode;
    this.type = TYPE.indexOf(o.type) !== -1 ? o.type : DEFAULT_OPTIONS.type;
    this.dateType = DATETYPE.indexOf(o.dateType) !== -1 ? o.dateType : DEFAULT_OPTIONS.dateType;
    this.hourType = HOURTYPE.indexOf(o.hourType) !== -1 ? o.hourType : DEFAULT_OPTIONS.hourType;
    this.allowEmpty = o.allowEmpty;
    this.showArrowButtons = o.showArrowButtons;
    this.orientation = o.showArrowButtons ? true : o.orientation;
    if ((o.value == null || o.value == '') && o.allowEmpty) {
      this.setEmptyValue();
    } else {
      this.value = this.setValue(o.value || new Date());
      if (typeof this.value.day !== 'undefined' && isNaN(this.value.day) || typeof this.value.hour !== 'undefined' && isNaN(this.value.hour)) {
        this.setInvalidValue();
      }
    }
    this.initialValue = _objectSpread2({}, this.value);
    this.els = {};
    this.el.classList.add('wdp');
    this.el.innerHTML = "\n            <div class=\"wdp-container\">\n                <div class=\"wdp-header\">\n                    <span></span>\n                    <div>\n                        <div></div>\n                        <div>\n                            <svg width=\"16\" height=\"16\" viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z\"></path></svg>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"wdp-body\"></div>\n            </div>\n        ";
    this.els.container = this.el.querySelector('.wdp-container');
    this.els.span = this.el.querySelector('.wdp-header span');
    this.setSpanText();
    this.els.cross = this.el.querySelector('.wdp-header > div > div:last-child svg');
    this.els.body = this.el.querySelector('.wdp-body');
    if (this.type != HOUR) {
      this.page = DATE;
      this.datePage = MONTH;
      if (this.value.month > 0) {
        this.tmpValue = {
          month: this.value.month,
          year: this.value.year
        };
      } else {
        var d = new Date();
        this.tmpValue = {
          month: d.getMonth() + 1,
          year: d.getFullYear()
        };
      }
      this.tmpYearValue = {};
      this.tmpYearRangeValue = {};
      this.els.body.innerHTML = "\n                <div class=\"wdp-date-container\">\n                    <div class=\"wdp-date-header\">\n                        <span></span>\n                        <div>\n                            <div>\n                                ".concat(this.renderUpIcon(), "\n                            </div>\n                            <div>\n                                ").concat(this.renderDownIcon(), "\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"wdp-date-body\">\n                        <div class=\"wdp-week-container\">\n                            <div class=\"wdp-week-header\">\n                                <ul class=\"wdp-week\">\n                                    <li>").concat(this.LANG.DAYS_ABBR[1].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[2].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[3].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[4].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[5].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[6].substring(0, 2), "</li>\n                                    <li>").concat(this.LANG.DAYS_ABBR[7].substring(0, 2), "</li>\n                                </ul>\n                            </div>\n                            <div class=\"wdp-week-body\"></div>\n                        </div>\n                        <div class=\"wdp-list-container\"></div>\n                        <div class=\"wdp-list-container\"></div>\n                    </div>\n                </div>\n            ");
      this.els.dateContainer = this.el.querySelector('.wdp-date-container');
      this.els.weekContainer = this.el.querySelector('.wdp-week-container');
      this.els.dateSpan = this.el.querySelector('.wdp-date-container .wdp-date-header span');
      this.setDateSpanText();
      Util.addEventListener(this.els.dateSpan, [Util.MOUSE_DOWN], function (e) {
        e.preventDefault();
        if (_this.datePage == MONTH) {
          _this.changeDatePage(YEAR);
        } else if (_this.datePage == YEAR) {
          _this.changeDatePage(YEAR_RANGE);
        }
      });
      this.increaseDateValue = this.increaseDateValue.bind(this);
      this.decreaseDateValue = this.decreaseDateValue.bind(this);
      Util.addEventListener(this.els.body.querySelector('.wdp-date-header > div > div:first-child > svg'), [Util.MOUSE_DOWN], this.orientation ? this.increaseDateValue : this.decreaseDateValue);
      Util.addEventListener(this.els.body.querySelector('.wdp-date-header > div > div:last-child svg'), [Util.MOUSE_DOWN], !this.orientation ? this.increaseDateValue : this.decreaseDateValue);
      this.els.weekBody = this.el.querySelector('.wdp-date-container .wdp-date-body .wdp-week-body');
      this.renderMonth();
      this.setActiveDayClass();
      this.els.yearContainer = this.el.querySelector('.wdp-date-body .wdp-week-container + .wdp-list-container');
      this.els.yearRangeContainer = this.el.querySelector('.wdp-date-body .wdp-list-container:last-child');
    }
    if (this.type != DATE) {
      this.els.hourContainer = document.createElement('div');
      this.els.hourContainer.classList.add('wdp-hour-container');
      this.els.hourContainer.innerHTML = "\n                <div class=\"wdp-hour-arrow-container\">\n                    <div>\n                        ".concat(this.renderUpIcon(), "\n                    </div>\n                    <div>\n                        ").concat(this.renderUpIcon(), "\n                    </div>\n                    ").concat(this.hourType == $12 ? "<div>".concat(this.renderUpIcon(), "</div>") : '', "\n                </div>\n                <div class=\"wdp-hour-el-container\">\n                    <input type=\"text\" spellcheck=\"false\" class=\"wdp-hour-el\">\n                    <input type=\"text\" spellcheck=\"false\" class=\"wdp-hour-el\">\n                    ").concat(this.hourType == $12 ? '<input type="text" spellcheck="false" class="wdp-hour-el">' : '', "\n                </div>\n                <div class=\"wdp-hour-arrow-container\">\n                    <div>\n                        ").concat(this.renderDownIcon(), "\n                    </div>\n                    <div>\n                        ").concat(this.renderDownIcon(), "\n                    </div>\n                    ").concat(this.hourType == $12 ? "<div>".concat(this.renderDownIcon(), "</div>") : '', "\n                </div>\n            ");
      this.els.body.appendChild(this.els.hourContainer);
      this.els.hourInput = this.els.hourContainer.querySelector('.wdp-hour-el-container > input:nth-child(1)');
      this.els.hourInput.value = Util.renderNumber(this.value.hour || 0);
      Util.addEventListener(this.els.hourInput, ['change'], this.changeHourInput.bind(this));
      Util.addEventListener(this.els.hourInput, ['focus'], this.focusHoursInput.bind(this));
      Util.addEventListener(this.els.hourInput, ['blur'], this.leaveHoursInput.bind(this));
      Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-arrow-container > div:nth-child(1) > svg'), [Util.MOUSE_DOWN], function (e) {
        e.preventDefault();
        if (_this.orientation) _this.setHour(_this.value.hour + 1);else _this.setHour(_this.value.hour - 1);
      });
      Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-el-container + .wdp-hour-arrow-container > div:nth-child(1) > svg'), [Util.MOUSE_DOWN], function (e) {
        e.preventDefault();
        if (!_this.orientation) _this.setHour(_this.value.hour + 1);else _this.setHour(_this.value.hour - 1);
      });
      this.els.minuteInput = this.els.hourContainer.querySelector('.wdp-hour-el-container > input:nth-child(2)');
      this.els.minuteInput.value = Util.renderNumber(this.value.minute || 0);
      Util.addEventListener(this.els.minuteInput, ['change'], this.changeMinuteInput.bind(this));
      Util.addEventListener(this.els.minuteInput, ['focus'], this.focusHoursInput.bind(this));
      Util.addEventListener(this.els.minuteInput, ['blur'], this.leaveHoursInput.bind(this));
      Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-arrow-container > div:nth-child(2) > svg'), [Util.MOUSE_DOWN], function (e) {
        e.preventDefault();
        if (_this.orientation) _this.setMinute(_this.value.minute + 1);else _this.setMinute(_this.value.minute - 1);
      });
      Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-el-container + .wdp-hour-arrow-container > div:nth-child(2) > svg'), [Util.MOUSE_DOWN], function (e) {
        e.preventDefault();
        if (!_this.orientation) _this.setMinute(_this.value.minute + 1);else _this.setMinute(_this.value.minute - 1);
      });
      if (this.hourType == $12) {
        this.els.amInput = this.els.hourContainer.querySelector('.wdp-hour-el-container > input:nth-child(3)');
        this.els.amInput.value = this.value.am ? this.LANG.AM_PM[0] : this.LANG.AM_PM[1];
        Util.addEventListener(this.els.amInput, ['change'], this.changeAMInput.bind(this));
        Util.addEventListener(this.els.amInput, ['focus'], this.focusHoursInput.bind(this));
        Util.addEventListener(this.els.amInput, ['blur'], this.leaveHoursInput.bind(this));
        Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-arrow-container > div:nth-child(3) > svg'), [Util.MOUSE_DOWN], function (e) {
          e.preventDefault();
          _this.setAM(!_this.value.am);
        });
        Util.addEventListener(this.els.hourContainer.querySelector('.wdp-hour-el-container + .wdp-hour-arrow-container > div:nth-child(3) > svg'), [Util.MOUSE_DOWN], function (e) {
          e.preventDefault();
          _this.setAM(!_this.value.am);
        });
      }
      if (this.type == HOUR) {
        this.page = HOUR;
      } else {
        this.els.hourContainer.classList.add('wdp-d-none');
        this.els.pageToggle = this.el.querySelector('.wdp-header > div > div:first-child');
        this.els.pageToggle.innerHTML = "\n                    <svg width=\"16\" height=\"16\" viewBox=\"0 0 1792 1792\" class=\"wdp-non-opaque\"><path d=\"M192 1664h1408v-1024h-1408v1024zm384-1216v-288q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v288q0 14 9 23t23 9h64q14 0 23-9t9-23zm768 0v-288q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v288q0 14 9 23t23 9h64q14 0 23-9t9-23zm384-64v1280q0 52-38 90t-90 38h-1408q-52 0-90-38t-38-90v-1280q0-52 38-90t90-38h128v-96q0-66 47-113t113-47h64q66 0 113 47t47 113v96h384v-96q0-66 47-113t113-47h64q66 0 113 47t47 113v96h128q52 0 90 38t38 90z\"></path></svg>                    \n                    <svg width=\"16\" height=\"16\" viewBox=\"0 0 1792 1792\"><path d=\"M1024 544v448q0 14-9 23t-23 9h-320q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h224v-352q0-14 9-23t23-9h64q14 0 23 9t9 23zm416 352q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z\"></path></svg>       \n                ";
        var icons = this.els.pageToggle.querySelectorAll('svg');
        for (var i = 0; i < icons.length; i++) {
          Util.addEventListener(icons[i], [Util.MOUSE_DOWN], this.changePage.bind(this));
        }
      }
    }
    this.changeInput = this.changeInput.bind(this);
    this.wheelHourInput = this.wheelHourInput.bind(this);
    this.wheelMinuteInput = this.wheelMinuteInput.bind(this);
    this.wheelAMInput = this.wheelAMInput.bind(this);
    this.setPosition = this.setPosition.bind(this);
    this.clickWindow = this.clickWindow.bind(this);
    this.open = this.open.bind(this);
    this.toggle = this.toggle.bind(this);
    this.pickerOpen = false;
    this.inputToggle = o.inputToggle;
    if (this.inputEl) {
      Util.addEventListener(this.inputEl, ['change'], this.changeInput);
      if (o.inputToggle) {
        Util.addEventListener(this.inputEl, [Util.MOUSE_DOWN], this.open);
      }
    }
    this.setInputText();
    Util.addEventListener(this.els.cross, [Util.MOUSE_DOWN], this.clickCross.bind(this));
    this.showButtons = o.showButtons;
    if (o.showButtons) {
      var buttonsCont = document.createElement('div');
      buttonsCont.classList.add('wdp-buttons');
      buttonsCont.innerHTML = "\n                <a href=\"javascript:void(0)\" tabindex=\"-1\">".concat(this.LANG.BUTTONS[0], "</a>\n                <a href=\"javascript:void(0)\" tabindex=\"-1\">").concat(this.LANG.BUTTONS[1], "</a>\n            ");
      Util.addEventListener(buttonsCont.querySelector('a:last-child'), [Util.MOUSE_UP], this.save.bind(this));
      Util.addEventListener(buttonsCont.querySelector('a:first-child'), [Util.MOUSE_UP], this.cancel.bind(this));
      this.els.container.appendChild(buttonsCont);
    }
    if (this.toggleEl) {
      Util.addEventListener(this.toggleEl, [Util.MOUSE_DOWN], this.toggle);
    }
  }

  /**
   * Extracts attributes from default options.
   * 
   * @param {Object} opt
   * @returns {Object}
   */
  _createClass(DatePicker, [{
    key: "extractAttributes",
    value: function extractAttributes(opt) {
      var o = {};
      for (var i in DEFAULT_OPTIONS) {
        if (typeof opt[i] !== 'undefined') {
          o[i] = opt[i];
        } else {
          o[i] = DEFAULT_OPTIONS[i];
        }
      }
      return o;
    }

    /**
     * Renders a month and attach event listeners.
     */
  }, {
    key: "renderMonth",
    value: function renderMonth() {
      this.els.weekBody.innerHTML = '';
      var cur = this.tmpValue.month,
        curYear = this.tmpValue.year,
        prv = cur - 1,
        prvYear = curYear,
        nxt = cur + 1,
        nxtYear = curYear;
      if (prv == 0) {
        prv = 12;
        prvYear -= 1;
      } else if (nxt == 13) {
        nxt = 1;
        nxtYear += 1;
      }
      var fd = this.getWeekDay(new Date(curYear, cur - 1, 1)),
        pdc = Util.getDayCount(prv, prvYear),
        pd = 1,
        pwd = fd - 1,
        dc = Util.getDayCount(cur, curYear),
        d = 1,
        w = 0,
        wd = pwd,
        nd = 1,
        ul = this.createDayCont(),
        li;
      this.els.weekBody.appendChild(ul);
      while (pd <= pwd) {
        li = this.createDayEl(pdc + (pd - pwd), prv, prvYear, true);
        ul.appendChild(li);
        pd += 1;
      }
      while (d <= dc) {
        li = this.createDayEl(d, cur, curYear, false);
        ul.appendChild(li);
        d += 1;
        wd += 1;
        if (wd == 7) {
          ul = this.createDayCont();
          this.els.weekBody.appendChild(ul);
          wd = 0;
          w += 1;
        }
      }
      while (w < 6) {
        li = this.createDayEl(nd, nxt, nxtYear, true);
        ul.appendChild(li);
        nd += 1;
        wd += 1;
        if (wd == 7) {
          if (w < 5) {
            ul = this.createDayCont();
            this.els.weekBody.appendChild(ul);
          }
          wd = 0;
          w += 1;
        }
      }
    }

    /**
     * Renders a year and attach event listeners.
     */
  }, {
    key: "renderYear",
    value: function renderYear() {
      var _this2 = this;
      this.els.yearContainer.innerHTML = '';
      var cur = this.tmpYearValue.year,
        nxt = cur + 1,
        i = 1,
        ul,
        li;
      var _loop = function _loop() {
        var n = i,
          y = cur,
          txt = _this2.LANG.MONTHS_ABBR[i];
        if ((i - 1) % 4 == 0) {
          ul = document.createElement('ul');
          ul.classList.add('wdp-list');
          _this2.els.yearContainer.appendChild(ul);
        }
        li = document.createElement('li');
        if (i > 12) {
          n = i - 12;
          y = nxt;
          txt = _this2.LANG.MONTHS_ABBR[i - 12];
          li.classList.add('wdp-muted');
        }
        li.setAttribute('date', "".concat(n, "-").concat(y));
        li.innerHTML = txt;
        Util.addEventListener(li, [Util.MOUSE_DOWN], function () {
          _this2.tmpValue = {
            month: n,
            year: y
          };
          _this2.changeDatePage(MONTH);
        });
        ul.appendChild(li);
        i += 1;
      };
      while (i <= 16) {
        _loop();
      }
    }

    /**
     * Renders year range.
     */
  }, {
    key: "renderYearRange",
    value: function renderYearRange() {
      var _this3 = this;
      this.els.yearRangeContainer.innerHTML = '';
      var _this$tmpYearRangeVal = this.tmpYearRangeValue,
        year = _this$tmpYearRangeVal.year,
        start = _this$tmpYearRangeVal.start,
        end = _this$tmpYearRangeVal.end,
        i = 0,
        ul,
        li;
      var _loop2 = function _loop2() {
        var y = start + i;
        if (i % 4 == 0) {
          ul = document.createElement('ul');
          ul.classList.add('wdp-list');
          _this3.els.yearRangeContainer.appendChild(ul);
        }
        li = document.createElement('li');
        li.innerHTML = y;
        if (y >= end) {
          li.classList.add('wdp-muted');
        }
        li.setAttribute('date', y);
        Util.addEventListener(li, [Util.MOUSE_DOWN], function () {
          _this3.tmpYearValue = {
            year: y,
            month: 0
          };
          _this3.changeDatePage(YEAR);
        });
        ul.appendChild(li);
        i += 1;
      };
      while (i < 16) {
        _loop2();
      }
    }

    /**
     * Renders up icon.
     * 
     * @returns {String}
     */
  }, {
    key: "renderUpIcon",
    value: function renderUpIcon() {
      if (this.showArrowButtons) return '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1600 736v192q0 40-28 68t-68 28h-416v416q0 40-28 68t-68 28h-192q-40 0-68-28t-28-68v-416h-416q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h416v-416q0-40 28-68t68-28h192q40 0 68 28t28 68v416h416q40 0 68 28t28 68z"/></svg>';else return '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z"></path></svg>';
    }

    /**
     * Renders down icon.
     * 
     * @returns {String}
     */
  }, {
    key: "renderDownIcon",
    value: function renderDownIcon() {
      if (this.showArrowButtons) return '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1600 736v192q0 40-28 68t-68 28h-1216q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h1216q40 0 68 28t28 68z"/></svg>';else return '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"></path></svg>';
    }

    /**
     * Sets value according to input text.
     */
  }, {
    key: "changeInput",
    value: function changeInput() {
      var val,
        oval = this.value;
      try {
        if (!this.inputEl.value.trim() && this.allowEmpty) {
          this.setEmptyValue();
        } else {
          val = this.setValue(this.inputEl.value);
          if (typeof val.day !== 'undefined' && isNaN(val.day) || typeof val.hour !== 'undefined' && isNaN(val.hour)) {
            throw null;
          }
          this.value = val;
        }
        this.initialValue = _objectSpread2({}, this.value);
        this.resetDatePage();
      } catch (ignored) {
        this.setInvalidValue();
        this.initialValue = _objectSpread2({}, this.value);
        this.setActiveDayClass();
        this.setInputText();
      } finally {
        this.resetHourPage();
        this.setSpanText();
        if (this.value.value != oval.value) {
          this.el.dispatchEvent(CHANGE);
        }
      }
    }

    /**
     * Changes hour according to input value.
     */
  }, {
    key: "changeHourInput",
    value: function changeHourInput() {
      var val = parseInt(this.els.hourInput.value);
      if (isNaN(val)) {
        this.els.hourInput.value = Util.renderNumber(this.value.hour);
      } else {
        if (val != this.value.hour) {
          this.setHour(val, false);
        }
      }
    }

    /**
     * Changes minute according to input value.
     */
  }, {
    key: "changeMinuteInput",
    value: function changeMinuteInput() {
      var val = parseInt(this.els.minuteInput.value);
      if (isNaN(val)) {
        this.els.minuteInput.value = Util.renderNumber(this.value.minute);
      } else {
        if (val != this.value.minute) {
          this.setMinute(val, false);
        }
      }
    }

    /**
     * Changes am/pm according to input value.
     */
  }, {
    key: "changeAMInput",
    value: function changeAMInput() {
      var val = (this.els.amInput.value || '').toUpperCase();
      if (val == this.LANG.AM_PM[1] && this.value.am) {
        this.setAM(false);
      } else if (val == this.LANG.AM_PM[0] && !this.value.am) {
        this.setAM(true);
      } else {
        this.els.amInput.value = this.value.am ? this.LANG.AM_PM[0] : this.LANG.AM_PM[1];
      }
    }

    /**
     * Changes page.
     */
  }, {
    key: "changePage",
    value: function changePage() {
      if (this.page == DATE) {
        this.page = HOUR;
        Util.removeClass(this.els.pageToggle.querySelector('svg:first-child'), 'wdp-non-opaque');
        Util.addClass(this.els.pageToggle.querySelector('svg:last-child'), 'wdp-non-opaque');
        this.setPageAnimation(this.els.dateContainer, this.els.hourContainer, 'in', 'out');
      } else {
        this.page = DATE;
        Util.addClass(this.els.pageToggle.querySelector('svg:first-child'), 'wdp-non-opaque');
        Util.removeClass(this.els.pageToggle.querySelector('svg:last-child'), 'wdp-non-opaque');
        this.setPageAnimation(this.els.hourContainer, this.els.dateContainer, 'out-rev', 'in-rev');
      }
    }

    /**
     * Changes date page.
     * 
     * @param {String} val 
     */
  }, {
    key: "changeDatePage",
    value: function changeDatePage(val) {
      var _this4 = this;
      var v = this.datePage,
        o,
        n,
        a,
        b;
      if (v == MONTH) {
        o = this.els.weekContainer;
      } else if (v == YEAR) {
        o = this.els.yearContainer;
      } else {
        o = this.els.yearRangeContainer;
      }
      this.datePage = val;
      setTimeout(function () {
        _this4.setDateSpanText();
      }, 125);
      if (val == MONTH) {
        n = this.els.weekContainer;
        this.renderMonth();
        this.setActiveDayClass();
      } else if (val == YEAR) {
        n = this.els.yearContainer;
        if (v == MONTH) {
          this.tmpYearValue = {
            year: this.tmpValue.year,
            month: this.tmpValue.month
          };
        }
        this.renderYear();
        this.setActiveMonthClass();
      } else {
        n = this.els.yearRangeContainer;
        if (v == YEAR) {
          this.tmpYearRangeValue = _objectSpread2({
            year: this.tmpYearValue.year
          }, Util.getStartEndYear(this.tmpYearValue.year));
        }
        this.renderYearRange();
        this.setActiveYearClass();
      }
      if (v == MONTH && val == YEAR || v == YEAR && val == YEAR_RANGE) {
        a = 'in';
        b = 'out';
      } else if (v == YEAR && val == MONTH || v == YEAR_RANGE && val == YEAR) {
        a = 'out-rev';
        b = 'in-rev';
      }
      this.setPageAnimation(o, n, a, b);
    }

    /**
     * Attach wheel event listeners to document.
     * 
     * @param {Event} e 
     */
  }, {
    key: "focusHoursInput",
    value: function focusHoursInput(e) {
      if (e.target == this.els.hourInput) {
        Util.addEventListener(document, Util.WHEEL_EVENTS, this.wheelHourInput);
      } else if (e.target == this.els.minuteInput) {
        Util.addEventListener(document, Util.WHEEL_EVENTS, this.wheelMinuteInput);
      } else if (e.target == this.els.amInput) {
        Util.addEventListener(document, Util.WHEEL_EVENTS, this.wheelAMInput);
      }
    }

    /**
     * Removes wheel event listeners to document.
     * 
     * @param {Event} e 
     */
  }, {
    key: "leaveHoursInput",
    value: function leaveHoursInput(e) {
      if (e.target == this.els.hourInput) {
        Util.removeEventListener(document, Util.WHEEL_EVENTS, this.wheelHourInput);
      } else if (e.target == this.els.minuteInput) {
        Util.removeEventListener(document, Util.WHEEL_EVENTS, this.wheelMinuteInput);
      } else if (e.target == this.els.amInput) {
        Util.removeEventListener(document, Util.WHEEL_EVENTS, this.wheelAMInput);
      }
    }

    /**
     * Resets date if value is null.
     */
  }, {
    key: "resetDate",
    value: function resetDate() {
      if (this.type != HOUR && this.value.day == -1) {
        var d = new Date();
        this.setDay(d.getDate(), d.getMonth() + 1, d.getFullYear(), false);
      }
    }

    /**
     * Resets date page.
     */
  }, {
    key: "resetDatePage",
    value: function resetDatePage() {
      if (this.type != HOUR) {
        this.datePage = MONTH;
        if (this.value.day > 0) {
          this.tmpValue = {
            month: this.value.month,
            year: this.value.year
          };
        } else {
          var d = new Date();
          this.tmpValue = {
            month: d.getMonth() + 1,
            year: d.getFullYear()
          };
        }
        this.renderMonth();
        this.setActiveDayClass();
        this.setDateSpanText();
        this.els.weekContainer.classList.remove('wdp-d-none');
        this.els.yearContainer.classList.add('wdp-d-none');
        this.els.yearContainer.innerHTML = '';
        this.els.yearRangeContainer.classList.add('wdp-d-none');
        this.els.yearRangeContainer.innerHTML = '';
      }
    }

    /**
     * Resets hour page.
     */
  }, {
    key: "resetHourPage",
    value: function resetHourPage() {
      if (this.type != DATE) {
        this.els.hourInput.value = Util.renderNumber(this.value.hour || '');
        this.els.minuteInput.value = Util.renderNumber(this.value.minute || '');
        if (this.hourType == $12) {
          this.els.amInput.value = this.value.am ? this.LANG.AM_PM[0] : this.LANG.AM_PM[1];
        }
      }
    }

    /**
     * Sets hour input according to wheel.
     * 
     * @param {Event} e 
     */
  }, {
    key: "wheelHourInput",
    value: function wheelHourInput(e) {
      var delta = (e.deltaY || -e.wheelDelta || e.detail) >> 10 || 1;
      if (this.orientation) {
        delta = ~delta;
      }
      if (delta < 0) {
        this.setHour(this.value.hour - 1);
      } else {
        this.setHour(this.value.hour + 1);
      }
    }

    /**
     * Sets minute input according to wheel.
     * 
     * @param {Event} e 
     */
  }, {
    key: "wheelMinuteInput",
    value: function wheelMinuteInput(e) {
      var delta = (e.deltaY || -e.wheelDelta || e.detail) >> 10 || 1;
      if (this.orientation) {
        delta = ~delta;
      }
      if (delta < 0) {
        this.setMinute(this.value.minute - 1);
      } else {
        this.setMinute(this.value.minute + 1);
      }
    }

    /**
     * Sets am/pm input according to wheel.
     */
  }, {
    key: "wheelAMInput",
    value: function wheelAMInput() {
      this.setAM(!this.value.am);
    }

    /**
     * Returns the value.
     * 
     * @returns {Object}
     */
  }, {
    key: "get",
    value: function get() {
      return this.value;
    }

    /**
     * Gets value text.
     *
     * @param {Object} value
     * @returns {String}
     */
  }, {
    key: "getValueText",
    value: function getValueText(value) {
      var txt = '';
      if (this.type != HOUR) {
        if (this.dateType == DMY) {
          txt = "".concat(Util.renderNumber(value.day), "/").concat(Util.renderNumber(value.month), "/").concat(value.year);
        } else {
          txt = "".concat(Util.renderNumber(value.month), "/").concat(Util.renderNumber(value.day), "/").concat(value.year);
        }
      }
      if (this.type != DATE) {
        var am = '';
        if (this.hourType == $12) {
          am = value.am ? " ".concat(this.LANG.AM_PM[0]) : " ".concat(this.LANG.AM_PM[1]);
        }
        if (this.type == DATEHOUR) {
          txt += ' ';
        } else {
          txt = '';
        }
        txt += "".concat(Util.renderNumber(value.hour), ":").concat(Util.renderNumber(value.minute)).concat(am);
      }
      return txt;
    }

    /**
     * Gets week day of an date.
     * 
     * @param {Date} d
     * @returns {Number}
     */
  }, {
    key: "getWeekDay",
    value: function getWeekDay(d) {
      var weekDay = d.getDay();
      if (weekDay == 0) {
        return 7;
      }
      return weekDay;
    }

    /**
     * Sets value.
     * 
     * @param {String|Number|Date} v
     */
  }, {
    key: "set",
    value: function set(v) {
      if ((v == null || v == '') && this.allowEmpty) {
        this.setEmptyValue();
      } else {
        this.value = this.setValue(v);
      }
      this.initialValue = _objectSpread2({}, this.value);
      this.resetDatePage();
      this.resetHourPage();
      this.setSpanText();
      this.setInputText();
    }

    /**
     * Sets value from the given value type.
     * 
     * @param {String|Number|Date} v 
     * @returns {Object}
     */
  }, {
    key: "setValue",
    value: function setValue(v) {
      var date,
        value = {};
      if (typeof v === 'string') {
        var d = '1970-01-01',
          h = '00:00';
        if (this.type != HOUR) {
          var s = v.replace(/\//g, '-').split('-');
          s[2] = s[2].split(' ')[0];
          if (this.dateType == DMY) {
            s = [s[2], s[1], s[0]];
          } else {
            s = [s[2], s[0], s[1]];
          }
          d = "".concat(Util.renderNumber(s[0], 4), "-").concat(Util.renderNumber(s[1]), "-").concat(Util.renderNumber(s[2]));
        }
        if (this.type != DATE) {
          var s = v.split(' ');
          if (this.type == DATEHOUR) {
            s.shift();
          }
          var _s$0$split = s[0].split(':'),
            _s$0$split2 = _slicedToArray(_s$0$split, 2),
            hour = _s$0$split2[0],
            minute = _s$0$split2[1];
          if (this.hourType == $12) {
            if (s[1] == this.LANG.AM_PM[1] && hour != '12') {
              hour = (parseInt(hour) + 12).toString();
            } else if (s[1] == this.LANG.AM_PM[0] && hour == '12') {
              hour = '0';
            }
          }
          h = "".concat(Util.renderNumber(hour), ":").concat(Util.renderNumber(minute));
        }
        date = new Date(d);
        var hDate = new Date("1970-01-01T".concat(h, "Z"));
        hDate.setMinutes(hDate.getTimezoneOffset() + hDate.getMinutes());
        date.setHours(hDate.getHours());
        date.setMinutes(hDate.getMinutes());
      } else if (typeof v === 'number') {
        date = new Date(v);
      } else {
        date = v;
      }
      if (this.type != HOUR) {
        var weekDay = this.getWeekDay(date);
        value = {
          day: date.getDate(),
          weekDay: weekDay,
          month: date.getMonth() + 1,
          year: date.getFullYear()
        };
      }
      if (this.type != DATE) {
        value = _objectSpread2(_objectSpread2({}, value), {}, {
          hour: date.getHours(),
          minute: date.getMinutes()
        });
        if (this.hourType == $12) {
          if (value.hour > 11) {
            value.hour = value.hour != 12 ? value.hour - 12 : 12;
            value.am = false;
          } else {
            value.hour = value.hour == 0 ? 12 : value.hour;
            value.am = true;
          }
        }
      }
      value.value = this.getValueText(value);
      return value;
    }

    /**
     * Sets value as empty.
     */
  }, {
    key: "setEmptyValue",
    value: function setEmptyValue() {
      this.value = {
        value: '',
        day: 0,
        month: 0,
        year: 0
      };
    }

    /**
     * Sets value as invalid.
     */
  }, {
    key: "setInvalidValue",
    value: function setInvalidValue() {
      this.value = {
        value: this.LANG.INVALID_DATE,
        day: -1,
        month: -1,
        year: -1
      };
    }

    /**
     * Sets the selected day.
     * 
     * @param {Number} day
     * @param {Number} month
     * @param {Number} year
     * @param {Boolean} txt
     */
  }, {
    key: "setDay",
    value: function setDay(day, month, year) {
      var txt = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
      if (this.type != DATE && txt) {
        if (!this.value.hour) {
          this.setHour(NaN, true, false);
        }
      }
      var weekDay = this.getWeekDay(new Date(year, month - 1, day));
      this.value = _objectSpread2(_objectSpread2({}, this.value), {}, {
        day: day,
        weekDay: weekDay,
        month: month,
        year: year
      });
      this.setActiveDayClass();
      if (txt) {
        this.value.value = this.getValueText(this.value);
        this.setSpanText();
        this.setInputText();
        this.el.dispatchEvent(CHANGE);
      }
    }

    /**
     * Sets active day class.
     */
  }, {
    key: "setActiveDayClass",
    value: function setActiveDayClass() {
      if (this.type != HOUR) {
        var inact = this.els.weekBody.querySelector('.wdp-week > li.wdp-active'),
          act = this.els.weekBody.querySelector(".wdp-week > li[date=\"".concat(this.value.day, "-").concat(this.value.month, "-").concat(this.value.year, "\"]"));
        if (inact) {
          inact.classList.remove('wdp-active');
        }
        if (act) {
          act.classList.add('wdp-active');
        }
      }
    }

    /**
     * Sets temporary month.
     * 
     * @param {Number} month
     * @param {Number} year
     */
  }, {
    key: "setTmpMonth",
    value: function setTmpMonth(month, year) {
      this.tmpValue = {
        month: month,
        year: year
      };
      this.renderMonth();
      this.setDateSpanText();
      this.setActiveDayClass();
    }

    /**
     * Sets temporary year.
     * 
     * @param {Number} year 
     */
  }, {
    key: "setTmpYear",
    value: function setTmpYear(year) {
      this.tmpYearValue.year = year;
      this.renderYear();
      this.setDateSpanText();
      this.setActiveMonthClass();
    }

    /**
     * Sets active month class.
     */
  }, {
    key: "setActiveMonthClass",
    value: function setActiveMonthClass() {
      var inact = this.els.yearContainer.querySelector('.wdp-list > li.wdp-active'),
        act = this.els.yearContainer.querySelector(".wdp-list > li[date=\"".concat(this.tmpValue.month, "-").concat(this.tmpValue.year, "\"]"));
      if (inact) {
        inact.classList.remove('wdp-active');
      }
      if (act) {
        act.classList.add('wdp-active');
      }
    }

    /**
     * Sets temporary year range.
     * 
     * @param {Number} start
     */
  }, {
    key: "setTmpYearRange",
    value: function setTmpYearRange(start) {
      this.tmpYearRangeValue.start = start;
      this.tmpYearRangeValue.end = start + 10;
      this.renderYearRange();
      this.setDateSpanText();
      this.setActiveYearClass();
    }

    /**
     * Sets active year class.
     */
  }, {
    key: "setActiveYearClass",
    value: function setActiveYearClass() {
      var inact = this.els.yearRangeContainer.querySelector('.wdp-list > li.wdp-active'),
        act = this.els.yearRangeContainer.querySelector(".wdp-list > li[date=\"".concat(this.tmpYearValue.year, "\"]"));
      if (inact) {
        inact.classList.remove('wdp-active');
      }
      if (act) {
        act.classList.add('wdp-active');
      }
    }

    /**
     * Sets hour.
     * 
     * @param {Number} hour 
     * @param {Boolean} input 
     * @param {Boolean} txt
     */
  }, {
    key: "setHour",
    value: function setHour(hour) {
      var input = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var txt = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      this.resetDate();
      if (isNaN(hour)) {
        hour = 12;
        this.setMinute(0, true, false);
        if (this.hourType == $12) {
          this.setAM(true, true, false);
        }
      }
      var _hour = hour;
      if (this.hourType == $12) {
        if (hour <= 0) {
          hour = 12;
          this.setAM(!this.value.am, true, false);
        } else if (hour >= 13) {
          hour = 1;
          this.setAM(!this.value.am, true, false);
        }
      } else {
        if (hour <= -1) {
          hour = 23;
        } else if (hour >= 24) {
          hour = 0;
        }
      }
      this.value.hour = hour;
      if (input || !input && _hour != this.value.hour) {
        this.els.hourInput.value = Util.renderNumber(hour);
      }
      if (txt) {
        this.value.value = this.getValueText(this.value);
        this.setSpanText();
        this.setInputText();
        this.el.dispatchEvent(CHANGE);
      }
    }

    /**
     * Sets minute.
     * 
     * @param {Number} minute 
     * @param {Boolean} input 
     * @param {Boolean} txt 
     */
  }, {
    key: "setMinute",
    value: function setMinute(minute) {
      var input = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var txt = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      this.resetDate();
      if (isNaN(minute)) {
        minute = 0;
        this.setHour(0, true, false);
        if (this.hourType == $12) {
          this.setAM(true, true, false);
        }
      }
      var _minute = minute;
      if (minute <= -1) {
        minute = 59;
        this.setHour(this.value.hour - 1, true, false);
      } else if (minute >= 60) {
        minute = 0;
        this.setHour(this.value.hour + 1, true, false);
      }
      this.value.minute = minute;
      if (input || !input && _minute != this.value.minute) {
        this.els.minuteInput.value = Util.renderNumber(minute);
      }
      if (txt) {
        this.value.value = this.getValueText(this.value);
        this.setSpanText();
        this.setInputText();
        this.el.dispatchEvent(CHANGE);
      }
    }

    /**
     * Sets am/pm.
     * 
     * @param {Boolean} am 
     * @param {Boolean} input 
     * @param {Boolean} txt 
     */
  }, {
    key: "setAM",
    value: function setAM(am) {
      var input = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var txt = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      this.resetDate();
      if (!this.value.hour) {
        this.setHour(12, true, false);
        this.setMinute(0, true, false);
      }
      this.value.am = am;
      if (input) {
        this.els.amInput.value = this.value.am ? this.LANG.AM_PM[0] : this.LANG.AM_PM[1];
      }
      if (txt) {
        this.value.value = this.getValueText(this.value);
        this.setSpanText();
        this.setInputText();
        this.el.dispatchEvent(CHANGE);
      }
    }

    /**
     * Sets input text.
     */
  }, {
    key: "setInputText",
    value: function setInputText() {
      if (this.inputEl) {
        this.inputEl.value = this.value.value;
      }
    }

    /**
     * Sets span text.
     */
  }, {
    key: "setSpanText",
    value: function setSpanText() {
      var v = this.value;
      if (v.value == '' && this.type != HOUR) {
        this.els.span.innerHTML = '';
      } else if (v.day == -1 && this.type != HOUR) {
        this.els.span.innerHTML = this.LANG.INVALID_DATE;
      } else {
        if (this.type == HOUR) {
          var d = new Date(),
            weekDay = this.getWeekDay(d);
          v = {
            day: d.getDate(),
            weekDay: weekDay,
            month: d.getMonth() + 1,
            year: d.getFullYear()
          };
        }
        this.els.span.innerHTML = "".concat(this.LANG.DAYS_ABBR[v.weekDay], ", ").concat(v.day, " ").concat(this.LANG.MONTHS_ABBR[v.month], " ").concat(v.year);
      }
    }

    /**
     * Sets date span text.
     */
  }, {
    key: "setDateSpanText",
    value: function setDateSpanText() {
      var val;
      if (this.datePage == MONTH) {
        val = "".concat(this.LANG.MONTHS[this.tmpValue.month], " ").concat(this.tmpValue.year);
      } else if (this.datePage == YEAR) {
        val = this.tmpYearValue.year;
      } else {
        val = "".concat(this.tmpYearRangeValue.start, " - ").concat(this.tmpYearRangeValue.end);
      }
      this.els.dateSpan.innerHTML = val;
    }

    /**
     * Sets page animation.
     * 
     * @param {HTMLElement} o
     * @param {HTMLElement} n
     * @param {String} a
     * @param {String} b
     */
  }, {
    key: "setPageAnimation",
    value: function setPageAnimation(o, n, a, b) {
      o.classList.add("wdp-animation-fade-".concat(a));
      Util.addEventListenerOnce(o, Util.ANIMATION_END, function () {
        o.classList.add('wdp-d-none');
        o.classList.remove("wdp-animation-fade-".concat(a));
        n.classList.remove('wdp-d-none');
        var h = n.offsetHeight;
        n.classList.add("wdp-animation-fade-".concat(b));
        Util.addEventListenerOnce(n, Util.ANIMATION_END, function () {
          n.classList.remove("wdp-animation-fade-".concat(b));
        });
      });
    }

    /**
     * Sets the picker position.
     */
  }, {
    key: "setPosition",
    value: function setPosition() {
      var rect = this.parentEl.getBoundingClientRect(),
        ow = this.el.offsetWidth,
        oh = this.el.offsetHeight,
        x = rect.left + ow,
        _x = rect.left - ow,
        y = rect.top + rect.height + oh,
        _y = rect.top - oh,
        w = window.innerWidth,
        h = window.innerHeight;
      if (x >= w && _x > 0) {
        this.el.style.left = rect.left + rect.width - ow + 'px';
      } else {
        this.el.style.left = rect.left + 'px';
      }
      if (y >= h && _y > 0) {
        this.el.style.top = rect.top - oh + 'px';
      } else {
        this.el.style.top = rect.top + rect.height + 'px';
      }
    }

    /**
    * Increases date value by one.
    * 
    * @params {Event} e 
    */
  }, {
    key: "increaseDateValue",
    value: function increaseDateValue(e) {
      e.preventDefault();
      if (this.datePage == MONTH) {
        var _this$tmpValue = this.tmpValue,
          month = _this$tmpValue.month,
          year = _this$tmpValue.year;
        if (month == 12) {
          month = 1;
          year += 1;
        } else {
          month += 1;
        }
        this.setTmpMonth(month, year);
      } else if (this.datePage == YEAR) {
        var year = this.tmpYearValue.year;
        this.setTmpYear(year + 1);
      } else {
        var start = this.tmpYearRangeValue.start;
        this.setTmpYearRange(start + 10);
      }
    }

    /**
     * Decreases date value by one.
     * 
     * @params {Event} e
     */
  }, {
    key: "decreaseDateValue",
    value: function decreaseDateValue(e) {
      e.preventDefault();
      if (this.datePage == MONTH) {
        var _this$tmpValue2 = this.tmpValue,
          month = _this$tmpValue2.month,
          year = _this$tmpValue2.year;
        if (month == 1) {
          month = 12;
          year -= 1;
        } else {
          month -= 1;
        }
        this.setTmpMonth(month, year);
      } else if (this.datePage == YEAR) {
        var year = this.tmpYearValue.year;
        this.setTmpYear(year - 1);
      } else {
        var start = this.tmpYearRangeValue.start;
        this.setTmpYearRange(start - 10);
      }
    }

    /**
     * Creates day container.
     * 
     * @returns {HTMLUListElement}
     */
  }, {
    key: "createDayCont",
    value: function createDayCont() {
      var ul = document.createElement('ul');
      ul.classList.add('wdp-week');
      return ul;
    }

    /**
     * Creates day element and attaches event listener.
     * 
     * @param {Number} d
     * @param {Number} m
     * @param {Number} y
     * @param {Boolean} muted
     * @returns {HTMLLIElement}
     */
  }, {
    key: "createDayEl",
    value: function createDayEl(d, m, y, muted) {
      var _this5 = this;
      var li = document.createElement('li');
      li.setAttribute('date', "".concat(d, "-").concat(m, "-").concat(y));
      if (muted) {
        li.classList.add('wdp-muted');
      }
      li.innerHTML = d;
      Util.addEventListener(li, [Util.MOUSE_DOWN], function () {
        _this5.setDay(d, m, y);
      });
      return li;
    }

    /**
     * Detects the target if it's the picker element, if not, closes the picker.
     * 
     * @param {Event} e 
     */
  }, {
    key: "clickWindow",
    value: function clickWindow(e) {
      try {
        if (this.el == e.target || Util.contains(this.el, e.target)) {
          throw null;
        }
        if (this.toggleEl && (this.toggleEl == e.target || Util.contains(this.toggleEl, e.target))) {
          throw null;
        }
        if (this.inputToggle && this.inputEl && (this.inputEl == e.target || Util.contains(this.inputEl, e.target))) {
          throw null;
        }
        this.close();
      } catch (ignored) {}
    }

    /**
     * Closes or cancels the picker.
     */
  }, {
    key: "clickCross",
    value: function clickCross() {
      if (!this.showButtons) {
        this.close();
      } else {
        this.cancel();
      }
    }

    /**
     * Returns picker open status.
     * 
     * @returns {Boolean}
     */
  }, {
    key: "isOpen",
    value: function isOpen() {
      return this.pickerOpen;
    }

    /**
     * Opens the picker.
     */
  }, {
    key: "open",
    value: function open() {
      var _this6 = this;
      if (!this.isOpen()) {
        if (this.toggleEl) {
          Util.addClass(this.toggleEl, 'wdp-active');
        }
        this.el.classList.add('wdp-active');
        var h = this.el.offsetHeight;
        this.setPosition();
        this.els.container.classList.add('wdp-active');
        Util.addEventListenerOnce(this.els.container, Util.TRANSITION_END, function () {
          Util.addEventListener(window, ['resize', 'scroll'], _this6.setPosition);
          _this6.pickerOpen = true;
          _this6.el.dispatchEvent(OPEN);
          if (!_this6.showButtons) {
            Util.addEventListener(document, [Util.MOUSE_DOWN], _this6.clickWindow);
          }
        });
      }
    }

    /**
     * Closes the picker.
     */
  }, {
    key: "close",
    value: function close() {
      if (this.isOpen()) {
        if (this.toggleEl) {
          Util.removeClass(this.toggleEl, 'wdp-active');
        }
        this.els.container.classList.remove('wdp-active');
        this.el.classList.remove('wdp-active');
        Util.removeEventListener(window, ['resize', 'scroll'], this.setPosition);
        this.pickerOpen = false;
        this.el.dispatchEvent(CLOSE);
        if (this.showButtons) {
          Util.removeEventListener(document, [Util.MOUSE_DOWN], this.clickWindow);
        }
      }
    }

    /**
     * Toggles the picker.
     */
  }, {
    key: "toggle",
    value: function toggle() {
      if (!this.isOpen()) {
        this.open();
      } else {
        this.close();
      }
    }

    /**
     * Saves the picker.
     */
  }, {
    key: "save",
    value: function save() {
      this.initialValue = _objectSpread2({}, this.value);
      this.el.dispatchEvent(SAVE);
      this.close();
    }

    /**
     * Cancels the selection.
     */
  }, {
    key: "cancel",
    value: function cancel() {
      this.value = _objectSpread2({}, this.initialValue);
      this.el.dispatchEvent(CANCEL);
      this.close();
      this.resetDatePage();
      this.resetHourPage();
      this.setSpanText();
      this.setInputText();
    }

    /**
     * Destroys the picker.
     */
  }, {
    key: "destroy",
    value: function destroy() {
      if (this.isOpen()) {
        Util.removeEventListener(window, ['resize', 'scroll'], this.setPosition);
        if (this.showButtons) {
          Util.removeEventListener(document, [Util.MOUSE_DOWN], this.clickWindow);
        }
      }
      if (this.inputEl) {
        Util.removeEventListener(this.inputEl, ['change'], this.changeInput);
        if (this.inputToggle) {
          Util.removeEventListener(this.inputEl, [Util.MOUSE_DOWN], this.open);
        }
      }
      if (this.toggleEl) {
        Util.removeEventListener(this.toggleEl, [Util.MOUSE_DOWN], this.toggle);
      }
      this.el.innerHTML = '';
      this.el.classList.remove('wdp');
      this.el.dispatchEvent(DESTROY);
    }

    /**
     * Creates a new language.
     * 
     * @param {String} name
     * @param {Object} lang
     */
  }], [{
    key: "createLanguage",
    value: function createLanguage(name, lang) {
      this.LANG[name] = lang;
    }
  }]);
  return DatePicker;
}();
DatePicker.LANG = {};
DatePicker.createLanguage('en', EN);

module.exports = DatePicker;
