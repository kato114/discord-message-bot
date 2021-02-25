<?php

/*
 * This file is apart of the DiscordPHP project.
 *
 * Copyright (c) 2016-2020 David Cole <david.cole1340@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Discord\Exceptions;

/**
 * Thrown when a request that was executed from a part failed.
 *
 * @see \Discord\Parts\Part::save() Can be thrown when being saved.
 * @see \Discord\Parts\Part::delete() Can be thrown when being deleted.
 */
class PartRequestFailedException extends \Exception
{
}
